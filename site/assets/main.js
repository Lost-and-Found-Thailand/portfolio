(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var pointerFine = window.matchMedia("(pointer: fine)").matches;

  /* Sticky nav background on scroll */
  var nav = document.querySelector(".ldm-nav");
  if (nav) {
    var onScroll = function () {
      nav.classList.toggle("is-scrolled", window.scrollY > 8);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  /* Mobile menu toggle */
  var burger = document.querySelector(".ldm-burger");
  var mobileMenu = document.querySelector(".ldm-mobile-menu");
  if (burger && mobileMenu) {
    burger.addEventListener("click", function () {
      var open = burger.classList.toggle("is-open");
      mobileMenu.classList.toggle("is-open", open);
      burger.setAttribute("aria-expanded", open ? "true" : "false");
      document.body.style.overflow = open ? "hidden" : "";
    });
    mobileMenu.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        burger.classList.remove("is-open");
        mobileMenu.classList.remove("is-open");
        document.body.style.overflow = "";
      });
    });
  }

  /* Scroll reveal */
  var revealEls = document.querySelectorAll(".reveal");
  if (revealEls.length) {
    if (reduceMotion || !("IntersectionObserver" in window)) {
      revealEls.forEach(function (el) { el.classList.add("is-visible"); });
    } else {
      var io = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-visible");
              io.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.15, rootMargin: "0px 0px -40px 0px" }
      );
      var groupCounts = new Map();
      revealEls.forEach(function (el) {
        var parent = el.parentElement;
        var idx = groupCounts.get(parent) || 0;
        groupCounts.set(parent, idx + 1);
        el.style.transitionDelay = Math.min(idx, 5) * 70 + "ms";
        io.observe(el);
      });
    }
  }

  /* Number counters */
  var counters = document.querySelectorAll("[data-counter]");
  if (counters.length && !reduceMotion && "IntersectionObserver" in window) {
    var counterIO = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          counterIO.unobserve(entry.target);
          var el = entry.target;
          var target = parseFloat(el.getAttribute("data-counter"));
          var suffix = el.getAttribute("data-suffix") || "";
          var prefix = el.getAttribute("data-prefix") || "";
          var duration = 1200;
          var start = null;
          function step(ts) {
            if (start === null) start = ts;
            var progress = Math.min((ts - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var value = Math.round(target * eased);
            el.textContent = prefix + value + suffix;
            if (progress < 1) requestAnimationFrame(step);
          }
          requestAnimationFrame(step);
        });
      },
      { threshold: 0.5 }
    );
    counters.forEach(function (el) { counterIO.observe(el); });
  } else {
    counters.forEach(function (el) {
      var target = parseFloat(el.getAttribute("data-counter"));
      var suffix = el.getAttribute("data-suffix") || "";
      var prefix = el.getAttribute("data-prefix") || "";
      el.textContent = prefix + target + suffix;
    });
  }

  /* Split-word heading reveal */
  if (!reduceMotion) {
    var headings = document.querySelectorAll(".ldm-hero h1.fs-hero, .ldm-page-header h1");
    headings.forEach(function (el, headingIndex) {
      var text = el.textContent;
      el.setAttribute("aria-label", text);
      el.innerHTML = "";
      var tokens = text.split(/(\s+)/);
      var wordIndex = 0;
      tokens.forEach(function (token) {
        if (!token) return;
        if (/^\s+$/.test(token)) {
          el.appendChild(document.createTextNode(token));
          return;
        }
        var outer = document.createElement("span");
        outer.className = "ldm-word";
        outer.setAttribute("aria-hidden", "true");
        var inner = document.createElement("span");
        inner.className = "ldm-word-inner";
        inner.textContent = token;
        inner.style.transitionDelay = (headingIndex * 100 + wordIndex * 55) + "ms";
        outer.appendChild(inner);
        el.appendChild(outer);
        wordIndex += 1;
      });
      requestAnimationFrame(function () {
        requestAnimationFrame(function () { el.classList.add("is-split-visible"); });
      });
    });
  }

  /* Cursor spotlight glow */
  if (pointerFine && !reduceMotion) {
    var glow = document.createElement("div");
    glow.className = "ldm-cursor-glow";
    document.body.appendChild(glow);
    window.addEventListener(
      "pointermove",
      function (e) {
        glow.style.setProperty("--mx", e.clientX + "px");
        glow.style.setProperty("--my", e.clientY + "px");
        glow.classList.add("is-active");
      },
      { passive: true }
    );
    document.addEventListener("pointerleave", function () {
      glow.classList.remove("is-active");
    });
  }

  /* Nav hover slider pill */
  var navLinksEl = document.querySelector(".ldm-nav-links");
  if (navLinksEl && !reduceMotion) {
    var pill = document.createElement("span");
    pill.className = "ldm-nav-pill";
    navLinksEl.insertBefore(pill, navLinksEl.firstChild);
    navLinksEl.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("mouseenter", function () {
        var r = a.getBoundingClientRect();
        var pr = navLinksEl.getBoundingClientRect();
        pill.style.width = r.width + "px";
        pill.style.transform = "translate(" + (r.left - pr.left) + "px, -50%)";
        navLinksEl.classList.add("is-hovering");
      });
    });
    navLinksEl.addEventListener("mouseleave", function () {
      navLinksEl.classList.remove("is-hovering");
    });
  }

  /* Magnetic buttons */
  if (pointerFine && !reduceMotion) {
    var magneticEls = document.querySelectorAll(".btn, .ldm-nav-cta");
    magneticEls.forEach(function (el) {
      el.addEventListener("pointerenter", function () {
        el.style.transitionDuration = "0ms";
      });
      el.addEventListener("pointermove", function (e) {
        var r = el.getBoundingClientRect();
        var dx = e.clientX - (r.left + r.width / 2);
        var dy = e.clientY - (r.top + r.height / 2);
        el.style.transform = "translate3d(" + (dx * 0.25) + "px, " + (dy * 0.35) + "px, 0)";
      });
      el.addEventListener("pointerleave", function () {
        el.style.transitionDuration = "";
        el.style.transform = "";
      });
    });
  }

  /* 3D tilt on cards */
  if (pointerFine && !reduceMotion) {
    var tiltSelector = ".ldm-case, .ldm-service-detail, .ldm-service, .card";
    var tiltEls = Array.prototype.filter.call(
      document.querySelectorAll(tiltSelector),
      function (el) { return !el.querySelector("form"); }
    );
    tiltEls.forEach(function (el) {
      el.addEventListener("pointerenter", function () {
        el.style.transitionDuration = "0ms";
      });
      el.addEventListener("pointermove", function (e) {
        var r = el.getBoundingClientRect();
        var px = (e.clientX - r.left) / r.width - 0.5;
        var py = (e.clientY - r.top) / r.height - 0.5;
        var maxDeg = 5;
        el.style.transform =
          "perspective(900px) rotateX(" + (-py * maxDeg) + "deg) rotateY(" + (px * maxDeg) + "deg)";
      });
      el.addEventListener("pointerleave", function () {
        el.style.transitionDuration = "400ms";
        el.style.transform = "";
        el.addEventListener(
          "transitionend",
          function handler() {
            el.style.transitionDuration = "";
            el.removeEventListener("transitionend", handler);
          }
        );
      });
    });
  }

  /* Scroll progress bar */
  var progressBar = document.createElement("div");
  progressBar.className = "ldm-scroll-progress";
  document.body.appendChild(progressBar);
  var updateProgress = function () {
    var h = document.documentElement;
    var scrollable = h.scrollHeight - h.clientHeight;
    var pct = scrollable > 0 ? (h.scrollTop / scrollable) * 100 : 0;
    progressBar.style.width = pct + "%";
  };
  updateProgress();
  window.addEventListener("scroll", updateProgress, { passive: true });
  window.addEventListener("resize", updateProgress);

  /* Custom cursor: dot follows exactly, ring lags for a trailing feel */
  if (pointerFine && !reduceMotion) {
    document.body.classList.add("has-custom-cursor");
    var cursorDot = document.createElement("div");
    cursorDot.className = "ldm-cursor-dot";
    var cursorRing = document.createElement("div");
    cursorRing.className = "ldm-cursor-ring";
    document.body.appendChild(cursorDot);
    document.body.appendChild(cursorRing);

    var mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;
    window.addEventListener(
      "pointermove",
      function (e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
        cursorDot.style.transform = "translate(" + mouseX + "px," + mouseY + "px) translate(-50%,-50%)";
        cursorDot.classList.add("is-active");
        cursorRing.classList.add("is-active");
      },
      { passive: true }
    );
    document.addEventListener("pointerleave", function () {
      cursorDot.classList.remove("is-active");
      cursorRing.classList.remove("is-active");
    });

    (function ringLoop() {
      ringX += (mouseX - ringX) * 0.18;
      ringY += (mouseY - ringY) * 0.18;
      cursorRing.style.transform = "translate(" + ringX + "px," + ringY + "px) translate(-50%,-50%)";
      requestAnimationFrame(ringLoop);
    })();

    var hoverables = document.querySelectorAll(
      "a, button, .btn, input, textarea, select, .ldm-case, .card, .ldm-service, .ldm-service-detail"
    );
    hoverables.forEach(function (el) {
      el.addEventListener("pointerenter", function () { cursorRing.classList.add("is-hovering"); });
      el.addEventListener("pointerleave", function () { cursorRing.classList.remove("is-hovering"); });
    });
  }

  /* Cursor-follow "View Case Study" label */
  var caseCards = document.querySelectorAll(".ldm-case");
  if (pointerFine && !reduceMotion && caseCards.length) {
    var hoverLabel = document.createElement("div");
    hoverLabel.className = "ldm-hover-label";
    hoverLabel.textContent = "View Case Study →";
    document.body.appendChild(hoverLabel);
    caseCards.forEach(function (el) {
      el.addEventListener("pointerenter", function () { hoverLabel.classList.add("is-active"); });
      el.addEventListener("pointermove", function (e) {
        hoverLabel.style.transform = "translate(" + e.clientX + "px," + (e.clientY - 50) + "px) translate(-50%,-50%)";
      });
      el.addEventListener("pointerleave", function () { hoverLabel.classList.remove("is-active"); });
    });
  }
})();
