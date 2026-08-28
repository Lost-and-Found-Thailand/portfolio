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

  /* Mobile menu toggle. The overlay now sits above the header entirely
     (z-index) while open and carries its own close button (below), so
     nothing about closing the menu depends on the header staying visible
     or on top of it — see that button's comment for why. */
  var burger = document.querySelector(".ldm-burger");
  var mobileMenu = document.querySelector(".ldm-mobile-menu");
  if (mobileMenu && mobileMenu.parentElement !== document.body) {
    /* Move the menu out from under the sticky header: some WebKit/Safari
       versions mis-render a position:fixed element nested inside a
       position:sticky ancestor, letting it scroll with the page instead
       of staying pinned — which is exactly what caused it to overlap
       page content when opened mid-scroll. As a direct body child there
       is no ancestor stacking/containing-block ambiguity left. */
    document.body.appendChild(mobileMenu);
  }
  if (burger && mobileMenu) {
    /* The overlay's top bar, utility strip, link list and bottom action
       pills are all hand-authored in the HTML now (see the .ldm-mobile-menu
       markup in each page) rather than assembled here at runtime — this
       just wires up the close button already inside that markup. */
    var closeBtn = mobileMenu.querySelector(".ldm-mobile-menu-close");

    var setMenuOpen = function (open) {
      burger.classList.toggle("is-open", open);
      mobileMenu.classList.toggle("is-open", open);
      burger.setAttribute("aria-expanded", open ? "true" : "false");
      /* Lock scroll on both html and body — some in-app/WebView browsers
         only honor the lock on one of the two. */
      document.documentElement.style.overflow = open ? "hidden" : "";
      document.body.style.overflow = open ? "hidden" : "";
      if (nav) nav.classList.toggle("is-menu-open", open);
    };
    burger.addEventListener("click", function () {
      setMenuOpen(!burger.classList.contains("is-open"));
    });
    if (closeBtn) {
      closeBtn.addEventListener("click", function () {
        setMenuOpen(false);
      });
    }
    mobileMenu.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        setMenuOpen(false);
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

  /* Number counters — each one also flips its parent .ldm-metric to
     .is-counting at the exact same moment it starts ticking up, which
     is what drives that metric's radial progress ring (see
     .ldm-metric-ring in main.css). Ring and count-up share one
     trigger and one timeline instead of two things animating
     independently and hoping they read as connected. */
  var counters = document.querySelectorAll("[data-counter]");
  if (counters.length && !reduceMotion && "IntersectionObserver" in window) {
    var counterIO = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          counterIO.unobserve(entry.target);
          var el = entry.target;
          var metric = el.closest(".ldm-metric");
          if (metric) metric.classList.add("is-counting");
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
      var metric = el.closest(".ldm-metric");
      if (metric) metric.classList.add("is-counting");
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
      var innerWords = el.querySelectorAll(".ldm-word-inner");
      if (innerWords.length) innerWords[innerWords.length - 1].classList.add("ldm-word-shimmer");
      requestAnimationFrame(function () {
        requestAnimationFrame(function () { el.classList.add("is-split-visible"); });
      });
    });
  }

  /* Shimmer on the last word of major section headlines (no full split —
     these headings sit inside a .reveal element and already fade/slide in
     as a block, so only the trailing word is isolated) */
  if (!reduceMotion) {
    var subHeadings = document.querySelectorAll(".ldm-section-head h2, .ldm-about h2, .ldm-contact h2");
    subHeadings.forEach(function (el) {
      var text = el.textContent;
      var lastSpace = text.trimEnd().lastIndexOf(" ");
      var head = lastSpace === -1 ? "" : text.slice(0, lastSpace + 1);
      var lastWord = lastSpace === -1 ? text : text.slice(lastSpace + 1);
      if (!lastWord) return;
      el.innerHTML = "";
      el.appendChild(document.createTextNode(head));
      var span = document.createElement("span");
      span.className = "ldm-word-shimmer";
      span.textContent = lastWord;
      el.appendChild(span);
    });
  }

  /* Energy-fill on the big outline numerals (process steps, skills detail) */
  if (!reduceMotion) {
    var energyNums = document.querySelectorAll(".ldm-process-step .num, .ldm-service-detail-num");
    var energyIndex = 0;
    energyNums.forEach(function (el) {
      el.classList.add("ldm-energy-num");
      var fill = document.createElement("span");
      fill.className = "ldm-energy-num-fill";
      fill.setAttribute("aria-hidden", "true");
      fill.textContent = el.textContent;
      fill.style.transitionDelay = Math.min(energyIndex, 5) * 120 + "ms";
      el.appendChild(fill);
      energyIndex += 1;
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

  /* Scroll progress bar — already hidden under reduced motion via CSS
     (.ldm-scroll-progress is display:none in that media query), but the
     listener was still running and writing to the DOM every scroll tick
     for no visible benefit; skip setup entirely, matching how every other
     decorative-only feature in this file is gated. */
  if (!reduceMotion) {
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
  }

  /* Skills page connecting spine — fills in with scroll progress
     through the six numbered disciplines, desktop only (the layout
     collapses to a single column below 900px, where the numbers no
     longer sit at a fixed horizontal offset the line could track).
     Skipped under reduced motion, same reasoning as the progress bar
     above; the fill's default 0% height is already the right static
     state, so no CSS change is needed for that case. */
  if (!reduceMotion) {
    var spineFill = document.querySelector(".ldm-service-spine-fill");
    var spineList = document.querySelector(".ldm-service-detail-list");
    if (spineFill && spineList) {
      var spineTicking = false;
      var updateSpine = function () {
        spineTicking = false;
        if (!window.matchMedia("(min-width: 901px)").matches) {
          spineFill.style.height = "0%";
          return;
        }
        var rect = spineList.getBoundingClientRect();
        var focus = window.innerHeight * 0.7;
        var progress = (focus - rect.top) / rect.height;
        progress = Math.max(0, Math.min(1, progress));
        spineFill.style.height = progress * 100 + "%";
      };
      var onSpineScroll = function () {
        if (spineTicking) return;
        spineTicking = true;
        requestAnimationFrame(updateSpine);
      };
      updateSpine();
      window.addEventListener("scroll", onSpineScroll, { passive: true });
      window.addEventListener("resize", onSpineScroll);
    }
  }

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

  /* ----------------------------------------------------------------
     Concept network — the site's signature interaction: a small,
     curated graph of marketing concepts (not a generic particle
     field) that stays quiet until the visitor's cursor draws near,
     then reveals the specific relationships between ideas. Positions
     are scattered organically on purpose — the fixed edge list is
     what makes the connections feel intentional rather than random,
     since only real neighbors ever light up together.
     ---------------------------------------------------------------- */
  var networkCanvases = document.querySelectorAll("[data-network]");
  networkCanvases.forEach(function (canvas) { initNetwork(canvas); });

  function initNetwork(canvas) {
    var preset = {
      desktopNodes: ["Audience", "Insight", "Strategy", "Creative", "Campaign", "Engagement", "Conversion", "Growth"],
      desktopEdges: [
        ["Audience", "Insight"], ["Insight", "Strategy"],
        ["Strategy", "Creative"], ["Strategy", "Campaign"], ["Creative", "Campaign"],
        ["Campaign", "Engagement"], ["Campaign", "Conversion"], ["Engagement", "Conversion"],
        ["Conversion", "Growth"]
      ],
      mobileNodes: ["Audience", "Strategy", "Campaign", "Growth"],
      mobileEdges: [["Audience", "Strategy"], ["Strategy", "Campaign"], ["Campaign", "Growth"]]
    };
    var verbs = {
      Audience: "understand", Insight: "understand", Strategy: "connect",
      Creative: "create", Campaign: "activate", Engagement: "activate",
      Conversion: "convert", Growth: "grow"
    };

    var container = canvas.parentElement;
    var ctx = canvas.getContext("2d");
    if (!ctx) return;

    var isMobile = window.matchMedia("(max-width: 640px)").matches || !pointerFine;
    var names = isMobile ? preset.mobileNodes : preset.desktopNodes;
    var edgeDefs = isMobile ? preset.mobileEdges : preset.desktopEdges;

    var tooltip = document.createElement("div");
    tooltip.className = "ldm-network-tip";
    container.appendChild(tooltip);

    var width = 0, height = 0, dpr = Math.min(window.devicePixelRatio || 1, 2);
    var nodes = [];
    var edges = [];
    var pointer = { x: -9999, y: -9999, active: false };
    var hoveredNode = null;
    var running = false;
    var raf = null;
    var startTime = null;

    function pickPosition(w, h, safe, placed) {
      var margin = 22;
      var minDist = Math.max(40, Math.min(w, h) * 0.15);

      /* Sample only from the horizontal bands strictly above/below the
         text's bounding box — on narrow mobile widths that box spans
         nearly the full canvas, so rejecting samples inside it (and
         falling back to "closest miss" if none pass) can still land a
         node on top of the headline. Bands guarantee every candidate,
         including the min-distance fallback, is outside the text. */
      var bands = [];
      if (safe) {
        var topH = safe.y0 - margin;
        var bottomH = h - margin - safe.y1;
        if (topH > 30) bands.push({ y0: margin, y1: safe.y0 - 6, weight: topH });
        if (bottomH > 30) bands.push({ y0: safe.y1 + 6, y1: h - margin, weight: bottomH });
      }
      if (!bands.length) bands.push({ y0: margin, y1: Math.max(margin + 1, h - margin), weight: 1 });
      var totalWeight = bands.reduce(function (sum, b) { return sum + b.weight; }, 0);

      var best = null;
      for (var attempt = 0; attempt < 30; attempt++) {
        var r = Math.random() * totalWeight;
        var band = bands[bands.length - 1];
        for (var bi = 0; bi < bands.length; bi++) {
          if (r < bands[bi].weight) { band = bands[bi]; break; }
          r -= bands[bi].weight;
        }
        var x = margin + Math.random() * Math.max(1, w - margin * 2);
        var y = band.y0 + Math.random() * Math.max(1, band.y1 - band.y0);
        var okDist = true;
        for (var i = 0; i < placed.length; i++) {
          if (Math.hypot(placed[i].x - x, placed[i].y - y) < minDist) { okDist = false; break; }
        }
        if (okDist) return { x: x, y: y };
        if (!best) best = { x: x, y: y };
      }
      return best || { x: margin, y: margin };
    }

    function layout() {
      var rect = container.getBoundingClientRect();
      width = Math.max(1, rect.width);
      height = Math.max(1, rect.height);
      canvas.width = width * dpr;
      canvas.height = height * dpr;
      canvas.style.width = width + "px";
      canvas.style.height = height + "px";
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      var safe = null;
      var contentEl = container.querySelector(".ldm-hero-content");
      if (contentEl) {
        var cRect = contentEl.getBoundingClientRect();
        var pRect = container.getBoundingClientRect();
        safe = {
          x0: cRect.left - pRect.left - 20,
          y0: cRect.top - pRect.top - 20,
          x1: cRect.right - pRect.left + 20,
          y1: cRect.bottom - pRect.top + 20
        };
      }

      var prevByName = {};
      nodes.forEach(function (n) { prevByName[n.name] = n; });

      var placed = [];
      nodes = names.map(function (name) {
        var pos = pickPosition(width, height, safe, placed);
        placed.push(pos);
        var prev = prevByName[name];
        return {
          name: name,
          baseX: pos.x,
          baseY: pos.y,
          x: pos.x,
          y: pos.y,
          r: isMobile ? 3 : 3.2,
          phase: prev ? prev.phase : Math.random() * Math.PI * 2,
          freq: prev ? prev.freq : 0.12 + Math.random() * 0.1,
          ampX: 7 + Math.random() * 9,
          ampY: 6 + Math.random() * 7,
          energy: prev ? prev.energy : 0,
          targetEnergy: 0
        };
      });

      edges = edgeDefs.map(function (pair) {
        var a = null, b = null;
        for (var i = 0; i < nodes.length; i++) {
          if (nodes[i].name === pair[0]) a = nodes[i];
          if (nodes[i].name === pair[1]) b = nodes[i];
        }
        if (!a || !b) return null;
        return { a: a, b: b, pulseOffset: Math.random() };
      }).filter(Boolean);
    }

    function updateHover() {
      var found = null;
      for (var i = 0; i < nodes.length; i++) {
        var n = nodes[i];
        if (Math.hypot(n.x - pointer.x, n.y - pointer.y) < n.r + 12) { found = n; break; }
      }
      if (found !== hoveredNode) {
        hoveredNode = found;
        if (found) {
          tooltip.innerHTML = found.name.toUpperCase() +
            (verbs[found.name] ? '<span class="verb">' + verbs[found.name] + "</span>" : "");
          tooltip.classList.add("is-visible");
        } else {
          tooltip.classList.remove("is-visible");
        }
      }
      if (found) {
        tooltip.style.left = found.x + "px";
        tooltip.style.top = found.y + "px";
      }
    }

    function render(t) {
      if (startTime === null) startTime = t;
      var elapsed = reduceMotion ? 0 : (t - startTime) / 1000;

      nodes.forEach(function (n) {
        if (reduceMotion) {
          n.x = n.baseX;
          n.y = n.baseY;
        } else {
          n.x = n.baseX + Math.sin(elapsed * n.freq + n.phase) * n.ampX;
          n.y = n.baseY + Math.cos(elapsed * n.freq * 0.85 + n.phase) * n.ampY;
        }
        var target = 0;
        if (pointer.active) {
          var radius = isMobile ? Math.min(width, height) * 0.55 : 170;
          var d = Math.hypot(n.x - pointer.x, n.y - pointer.y);
          if (d < radius) target = 1 - d / radius;
        }
        n.targetEnergy = target;
      });

      /* One hop of propagation along real edges only — this is what
         makes a cluster "light up together" instead of every node
         reacting independently to the cursor. */
      edges.forEach(function (e) {
        var prop = Math.max(e.a.targetEnergy, e.b.targetEnergy) * 0.45;
        e.a.targetEnergy = Math.max(e.a.targetEnergy, prop);
        e.b.targetEnergy = Math.max(e.b.targetEnergy, prop);
      });

      var smoothing = reduceMotion ? 1 : 0.085;
      nodes.forEach(function (n) { n.energy += (n.targetEnergy - n.energy) * smoothing; });

      ctx.clearRect(0, 0, width, height);

      edges.forEach(function (e) {
        var strength = Math.min(e.a.energy, e.b.energy);
        if (strength < 0.08) return;
        var alpha = Math.min(strength * 0.55, 0.4);
        ctx.strokeStyle = "rgba(245,245,245," + alpha + ")";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(e.a.x, e.a.y);
        ctx.lineTo(e.b.x, e.b.y);
        ctx.stroke();

        if (!reduceMotion && strength > 0.22) {
          var pulseT = (elapsed * 0.3 + e.pulseOffset) % 1;
          var px = e.a.x + (e.b.x - e.a.x) * pulseT;
          var py = e.a.y + (e.b.y - e.a.y) * pulseT;
          ctx.beginPath();
          ctx.fillStyle = "rgba(200,255,0," + Math.min(strength, 0.85) + ")";
          ctx.arc(px, py, 1.7, 0, Math.PI * 2);
          ctx.fill();
        }
      });

      nodes.forEach(function (n) {
        var alpha = (isMobile ? 0.32 : 0.38) + n.energy * 0.5;
        var radius = n.r + n.energy * 1.6;
        ctx.beginPath();
        if (n.energy > 0.45) {
          ctx.fillStyle = "rgba(200,255,0," + Math.min(alpha, 1) + ")";
        } else {
          ctx.fillStyle = "rgba(245,245,245," + Math.min(alpha, 0.82) + ")";
        }
        ctx.arc(n.x, n.y, radius, 0, Math.PI * 2);
        ctx.fill();
      });

      updateHover();

      if (running && !reduceMotion) raf = requestAnimationFrame(render);
    }

    function renderOnce() { render(performance.now()); }

    function start() {
      if (running) return;
      running = true;
      if (reduceMotion) {
        renderOnce();
      } else {
        startTime = null;
        raf = requestAnimationFrame(render);
      }
    }
    function stop() {
      running = false;
      if (raf) cancelAnimationFrame(raf);
      raf = null;
    }

    function onMove(clientX, clientY) {
      var rect = container.getBoundingClientRect();
      pointer.x = clientX - rect.left;
      pointer.y = clientY - rect.top;
      pointer.active = true;
      if (reduceMotion) renderOnce();
    }
    function onLeave() {
      pointer.active = false;
      hoveredNode = null;
      tooltip.classList.remove("is-visible");
      if (reduceMotion) renderOnce();
    }

    if (pointerFine) {
      container.addEventListener("pointermove", function (e) { onMove(e.clientX, e.clientY); });
      container.addEventListener("pointerleave", onLeave);
    } else {
      /* Mobile: connections form from a tap/touch near a concept
         rather than from mouse movement, and fade back out shortly
         after the finger lifts instead of following a cursor. */
      container.addEventListener("touchstart", function (e) {
        var touch = e.touches[0];
        if (touch) onMove(touch.clientX, touch.clientY);
      }, { passive: true });
      container.addEventListener("touchmove", function (e) {
        var touch = e.touches[0];
        if (touch) onMove(touch.clientX, touch.clientY);
      }, { passive: true });
      container.addEventListener("touchend", function () {
        setTimeout(onLeave, 1100);
      });
    }

    layout();
    renderOnce();

    if ("IntersectionObserver" in window) {
      var vis = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) start(); else stop();
        });
      }, { threshold: 0.05 });
      vis.observe(container);
    } else {
      start();
    }

    document.addEventListener("visibilitychange", function () {
      if (document.hidden) stop();
      else {
        var rect = container.getBoundingClientRect();
        if (rect.bottom > 0 && rect.top < window.innerHeight) start();
      }
    });

    var resizeTimer = null;
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        layout();
        renderOnce();
      }, 150);
    });
  }

  /* ----------------------------------------------------------------
     Lens (SEE) — "I look deeper before I act." A soft circular field
     that sharpens a faint duplicate of scattered signal words as the
     cursor passes near. With no fine pointer, or under reduced
     motion, only the permanently-faint layer shows — a quiet texture
     rather than a broken interaction.
     ---------------------------------------------------------------- */
  document.querySelectorAll(".ldm-lens-host").forEach(function (host) {
    var field = host.querySelector(".ldm-lens-field");
    var blurred = host.querySelector(".ldm-lens-blurred");
    if (!field || !blurred) return;

    var sharp = blurred.cloneNode(true);
    sharp.classList.remove("ldm-lens-blurred");
    sharp.classList.add("ldm-lens-sharp");
    sharp.setAttribute("aria-hidden", "true");
    field.appendChild(sharp);

    if (!pointerFine || reduceMotion) return;

    host.addEventListener("pointermove", function (e) {
      var r = host.getBoundingClientRect();
      var x = e.clientX - r.left;
      var y = e.clientY - r.top;
      sharp.style.clipPath = "circle(130px at " + x + "px " + y + "px)";
    });
    host.addEventListener("pointerleave", function () {
      sharp.style.clipPath = "circle(0px at 50% 50%)";
    });
  });

  /* ----------------------------------------------------------------
     Ripple (ACTIVATE) — "one meaningful idea creates a chain
     reaction." A single expanding signal ring from wherever the
     cursor enters a project's media — a one-shot pulse, not a loop —
     contained by the media element's own overflow:hidden + radius.
     ---------------------------------------------------------------- */
  if (pointerFine && !reduceMotion) {
    document.querySelectorAll(".ldm-case-media").forEach(function (host) {
      host.addEventListener("pointerenter", function (e) {
        var r = host.getBoundingClientRect();
        var ripple = document.createElement("span");
        ripple.className = "ldm-ripple";
        ripple.style.left = (e.clientX - r.left) + "px";
        ripple.style.top = (e.clientY - r.top) + "px";
        host.appendChild(ripple);
        var cleanup = function () { if (ripple.parentNode) ripple.remove(); };
        ripple.addEventListener("animationend", cleanup);
        setTimeout(cleanup, 1200);
      });
    });
  }

  /* ----------------------------------------------------------------
     Spotlight — a soft radial highlight that follows the cursor over
     an image card, adapted from 21st.dev's "Spotlight Card"
     (@easemize). Delegated to one document-level listener rather than
     one per card, since the client photo grid alone has 53 of them.
     ---------------------------------------------------------------- */
  if (pointerFine && !reduceMotion) {
    document.addEventListener(
      "pointermove",
      function (e) {
        var host = e.target.closest(".card-image, .ldm-case-media");
        if (!host) return;
        var r = host.getBoundingClientRect();
        host.style.setProperty("--spot-x", (e.clientX - r.left) + "px");
        host.style.setProperty("--spot-y", (e.clientY - r.top) + "px");
      },
      { passive: true }
    );
  }

  /* ----------------------------------------------------------------
     Story rail — a persistent chapter map for the homepage. Chapters
     are evenly spaced by index rather than by actual scroll-percent
     of each section (which would need recalculating on every resize
     as content reflows) — it's a stylized map of the narrative, not
     a literal scrollbar. The active chapter is whichever section
     currently occupies the vertical center band of the viewport.
     ---------------------------------------------------------------- */
  (function () {
    var CHAPTERS = [
      { id: "hero", label: "See" },
      { id: "trusted-by", label: "Trusted" },
      { id: "intro", label: "Understand" },
      { id: "work", label: "Work" },
      { id: "services", label: "Strategy" },
      { id: "skills-tools", label: "Skills" },
      { id: "results", label: "Grow" },
      { id: "about-teaser", label: "About" },
      { id: "process", label: "Process" },
      { id: "contact-cta", label: "Connect" }
    ];
    var chapters = CHAPTERS
      .map(function (c) { return { el: document.getElementById(c.id), label: c.label }; })
      .filter(function (c) { return c.el; });
    if (chapters.length < 2) return;

    var rail = document.createElement("nav");
    rail.className = "ldm-story-rail";
    rail.setAttribute("aria-label", "Page sections");
    var track = document.createElement("div");
    track.className = "ldm-story-rail-track";
    var fill = document.createElement("div");
    fill.className = "ldm-story-rail-fill";
    rail.appendChild(track);
    rail.appendChild(fill);

    var nodes = chapters.map(function (c) {
      var node = document.createElement("button");
      node.type = "button";
      node.className = "ldm-story-node";
      node.setAttribute("aria-label", c.label);
      var dot = document.createElement("span");
      dot.className = "ldm-story-node-dot";
      var label = document.createElement("span");
      label.className = "ldm-story-node-label";
      label.textContent = c.label;
      node.appendChild(dot);
      node.appendChild(label);
      node.addEventListener("click", function () {
        c.el.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
      });
      rail.appendChild(node);
      return node;
    });
    document.body.appendChild(rail);

    var setActive = function (index) {
      nodes.forEach(function (n, i) { n.classList.toggle("is-active", i === index); });
      fill.style.height = (index / (nodes.length - 1)) * 100 + "%";
      /* On the mobile/tablet collapsed pill, hide it entirely while
         the hero chapter is active — the hero already shows plenty
         of its own context, so the pill would be redundant there. */
      rail.classList.toggle("is-past-hero", index > 0);
    };
    setActive(0);

    if ("IntersectionObserver" in window) {
      var chapterIO = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var idx = chapters.findIndex(function (c) { return c.el === entry.target; });
            if (idx !== -1) setActive(idx);
          });
        },
        { threshold: 0, rootMargin: "-45% 0px -45% 0px" }
      );
      chapters.forEach(function (c) { chapterIO.observe(c.el); });

      /* The rail is fixed at vertical-center of the viewport, which
         means it inevitably sits on top of whatever content is
         vertical-centered once someone scrolls all the way down —
         on every page that's the footer. Fade it out rather than let
         it overlap footer text. */
      var footerEl = document.querySelector(".ldm-footer");
      if (footerEl) {
        var footerIO = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              rail.classList.toggle("is-over-footer", entry.isIntersecting);
            });
          },
          { threshold: 0 }
        );
        footerIO.observe(footerEl);
      }
    }
  })();

  /* ----------------------------------------------------------------
     Chat widget — a small, honest FAQ assistant. It answers common
     questions from a fixed knowledge base (no external API, nothing
     to keep secret, nothing that can run up a bill), and hands off
     to WhatsApp for anything it can't answer or whenever someone
     asks for a real person.
     ---------------------------------------------------------------- */
  (function () {
    var WHATSAPP_URL = "https://wa.me/66626160129";
    var WHATSAPP_BTN =
      '<a class="ldm-chat-whatsapp-btn" href="' + WHATSAPP_URL + '" target="_blank" rel="noopener">' +
      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
      '<path d="M21 11.5a8.5 8.5 0 0 1-12.4 7.6L3 20l1-5.3A8.5 8.5 0 1 1 21 11.5z"></path>' +
      '<path d="M8.7 10.6c.3 2.4 2.3 4.4 4.7 4.7"></path></svg>' +
      "Message Liam on WhatsApp</a>";

    var INTENTS = [
      {
        keywords: ["human", "person", "real person", "speak to", "call me", "agent", "someone", "liam himself"],
        html: "Of course — Liam reads every WhatsApp message personally and usually replies fast." + WHATSAPP_BTN
      },
      {
        keywords: ["price", "pricing", "cost", "budget", "rate", "quote", "fee", "expensive", "cheap"],
        html: "Every project's scope is different, so there's no fixed price list here. Share a few details and Liam will get back to you with real numbers." + WHATSAPP_BTN
      },
      {
        keywords: ["service", "offer", "help with", "what can you", "what do you do", "capabilities"],
        html: "Liam works across <strong>Paid Media, Lead Generation, Conversion Tracking, Marketing Analytics, Conversion Optimization</strong> and <strong>Growth &amp; Digital Strategy</strong>. <a href=\"skills.html\">See the full skill set &rarr;</a>"
      },
      {
        keywords: ["process", "how do you work", "approach", "methodology", "steps"],
        html: "A simple, disciplined process: <strong>Discover</strong> the business and audience, <strong>Build</strong> the campaign and tracking, <strong>Optimize</strong> from real data, then <strong>Scale</strong> what works."
      },
      {
        keywords: ["result", "roas", "proof", "portfolio", "case stud", "example", "client", "brand", "track record"],
        html: "$10M+ in ad spend managed, 100+ brands scaled, 15x average ROAS and up to 300x on top campaigns. <a href=\"work.html\">See the case studies &rarr;</a>"
      },
      {
        keywords: ["tool", "platform", "stack", "software", "technology", "tech"],
        html: "Meta, Google, TikTok and LinkedIn Ads, GA4, Looker Studio, Google Tag Manager, HubSpot, WordPress and more. <a href=\"skills.html\">Full stack here &rarr;</a>"
      },
      {
        keywords: ["experience", "background", "who is liam", "about you", "years", "about liam"],
        html: "Liam's a Digital Marketing Manager with 6+ years managing multi-million-dollar budgets across hospitality, e-commerce and professional services. <a href=\"about.html\">More about Liam &rarr;</a>"
      },
      {
        keywords: ["available", "hire", "new project", "work together", "new client", "capacity", "start a project"],
        html: "Yes — currently available for select new projects. <a href=\"contact.html\">Start a conversation &rarr;</a> or" + WHATSAPP_BTN
      },
      {
        keywords: ["thank", "thanks", "cheers", "appreciate"],
        html: "Anytime! Anything else I can help with?"
      },
      {
        keywords: ["bye", "goodbye", "see you", "later"],
        html: "Take care! Liam's WhatsApp is always open if you want to keep talking." + WHATSAPP_BTN
      },
      {
        keywords: ["hi", "hello", "hey", "yo", "sup", "hiya"],
        html: "Hey! Ask me about services, process, results or tools — or jump straight to WhatsApp if you'd rather chat directly."
      }
    ];
    var FALLBACK_HTML =
      "I'm a simple assistant so I might not have that memorized — but Liam will. Want to message him directly?" + WHATSAPP_BTN;

    function matchIntent(text) {
      var lower = text.toLowerCase();
      var best = null, bestScore = 0;
      INTENTS.forEach(function (intent) {
        var score = 0;
        intent.keywords.forEach(function (kw) { if (lower.indexOf(kw) !== -1) score++; });
        if (score > bestScore) { bestScore = score; best = intent; }
      });
      return best ? best.html : FALLBACK_HTML;
    }

    function escapeHtml(str) {
      return str.replace(/[&<>"']/g, function (c) {
        return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
      });
    }

    var root = document.createElement("div");
    root.className = "ldm-chat";
    root.innerHTML =
      '<button type="button" class="ldm-chat-toggle" aria-label="Open chat" aria-expanded="false">' +
      '<span class="ldm-chat-badge" aria-hidden="true"></span>' +
      '<svg class="ldm-chat-icon-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.4 8.4 0 0 1-8.9 8.4 8.8 8.8 0 0 1-3.6-.8L3 20l1.1-3.9A8.3 8.3 0 0 1 3 11.5 8.5 8.5 0 0 1 11.5 3h.3A8.4 8.4 0 0 1 21 11.2z"></path></svg>' +
      '<svg class="ldm-chat-icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"></path></svg>' +
      "</button>" +
      '<div class="ldm-chat-panel" role="dialog" aria-label="Chat with Liam’s assistant" aria-hidden="true">' +
      '<div class="ldm-chat-header">' +
      "<div><strong>Liam's Assistant</strong><div class=\"ldm-chat-status\"><span class=\"status-dot\"></span>Usually replies instantly</div></div>" +
      '<button type="button" class="ldm-chat-close" aria-label="Close chat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"></path></svg></button>' +
      "</div>" +
      '<div class="ldm-chat-body" id="ldmChatBody"></div>' +
      '<div class="ldm-chat-quick" id="ldmChatQuick"></div>' +
      '<form class="ldm-chat-form" id="ldmChatForm">' +
      '<input type="text" id="ldmChatInput" placeholder="Ask about services, process, results…" autocomplete="off" aria-label="Message">' +
      '<button type="submit" aria-label="Send"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"></path></svg></button>' +
      "</form>" +
      "</div>";
    document.body.appendChild(root);

    var toggle = root.querySelector(".ldm-chat-toggle");
    var panel = root.querySelector(".ldm-chat-panel");
    var closeBtn = root.querySelector(".ldm-chat-close");
    var body = root.querySelector("#ldmChatBody");
    var quick = root.querySelector("#ldmChatQuick");
    var form = root.querySelector("#ldmChatForm");
    var input = root.querySelector("#ldmChatInput");

    function addMessage(role, html) {
      var el = document.createElement("div");
      el.className = "ldm-chat-msg " + role;
      el.innerHTML = html;
      body.appendChild(el);
      body.scrollTop = body.scrollHeight;
    }

    function showTyping(callback) {
      var typing = document.createElement("div");
      typing.className = "ldm-chat-typing";
      typing.innerHTML = "<span></span><span></span><span></span>";
      body.appendChild(typing);
      body.scrollTop = body.scrollHeight;
      setTimeout(function () {
        typing.remove();
        callback();
      }, reduceMotion ? 120 : 450 + Math.random() * 350);
    }

    function respond(text) {
      var html = matchIntent(text);
      showTyping(function () {
        addMessage("bot", html);
        body.scrollTop = body.scrollHeight;
      });
    }

    var QUICK_REPLIES = ["Services", "Process", "Results", "Talk to a human"];
    function renderQuick() {
      quick.innerHTML = "";
      QUICK_REPLIES.forEach(function (label) {
        var btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = label;
        btn.addEventListener("click", function () { sendUserMessage(label); });
        quick.appendChild(btn);
      });
    }

    function sendUserMessage(text) {
      text = text.trim();
      if (!text) return;
      addMessage("user", escapeHtml(text));
      input.value = "";
      respond(text);
    }

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      sendUserMessage(input.value);
    });

    var started = false;
    function openChat() {
      root.classList.add("is-open");
      toggle.setAttribute("aria-expanded", "true");
      panel.setAttribute("aria-hidden", "false");
      if (!started) {
        started = true;
        addMessage(
          "bot",
          "Hey, I'm Liam's assistant — ask me about services, process, results or tools. Need Liam himself? I can hand you straight to WhatsApp."
        );
        renderQuick();
      }
      setTimeout(function () { input.focus(); }, 250);
    }
    function closeChat() {
      root.classList.remove("is-open");
      toggle.setAttribute("aria-expanded", "false");
      panel.setAttribute("aria-hidden", "true");
    }
    toggle.addEventListener("click", function () {
      if (root.classList.contains("is-open")) closeChat();
      else openChat();
    });
    closeBtn.addEventListener("click", closeChat);
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && root.classList.contains("is-open")) closeChat();
    });

    /* Give chat controls the same cursor-ring hover feedback as the
       rest of the site's interactive elements, via delegation so it
       still applies to buttons rendered later (quick replies, the
       WhatsApp link inside a bot reply). */
    if (typeof cursorRing !== "undefined" && cursorRing) {
      root.addEventListener("pointerover", function (e) {
        if (e.target.closest && e.target.closest("button, a")) cursorRing.classList.add("is-hovering");
      });
      root.addEventListener("pointerout", function (e) {
        if (e.target.closest && e.target.closest("button, a")) cursorRing.classList.remove("is-hovering");
      });
    }
  })();

  /* ----------------------------------------------------------------
     Cookie notice — site-wide, all pages. Nothing here is currently
     gated behind the choice (the site doesn't set any cookies of its
     own yet), but it's recorded in localStorage so the banner
     doesn't reappear, and so any analytics/tracking added later has
     a real value to check before firing.
     ---------------------------------------------------------------- */
  (function () {
    if (localStorage.getItem("ldm-cookie-consent")) return;

    var bar = document.createElement("div");
    bar.className = "ldm-cookie-bar";
    bar.setAttribute("role", "region");
    bar.setAttribute("aria-label", "Cookie notice");
    bar.innerHTML =
      "<p>This site uses cookies to improve your browsing experience. By continuing, you agree to their use.</p>" +
      '<div class="ldm-cookie-actions">' +
      '<button type="button" class="ldm-cookie-decline">Decline</button>' +
      '<button type="button" class="ldm-cookie-accept">Accept</button>' +
      "</div>";
    document.body.appendChild(bar);
    document.body.classList.add("has-cookie-banner");

    var dismiss = function (choice) {
      localStorage.setItem("ldm-cookie-consent", choice);
      bar.classList.remove("is-visible");
      document.body.classList.remove("has-cookie-banner");
      setTimeout(function () { if (bar.parentNode) bar.remove(); }, 450);
    };
    bar.querySelector(".ldm-cookie-accept").addEventListener("click", function () { dismiss("accepted"); });
    bar.querySelector(".ldm-cookie-decline").addEventListener("click", function () { dismiss("declined"); });

    requestAnimationFrame(function () {
      /* Measured, not guessed — the bar can wrap to a taller two-line
         layout on narrow phones, and a fixed offset would either
         leave a gap or, worse, still overlap the chat button. */
      document.documentElement.style.setProperty("--cookie-bar-height", bar.getBoundingClientRect().height + "px");
      requestAnimationFrame(function () { bar.classList.add("is-visible"); });
    });
  })();

  /* ----------------------------------------------------------------
     Service worker: caches the self-hosted Spline runtime/scene files
     (sw.js) so a refresh or return visit serves them from local cache
     instead of depending on network conditions each time. Only worth
     installing at all if the Spline feature itself will run.

     window.LDM_SW_URL lets the WordPress mirror point this at the
     theme's own URL (set inline, before this file runs, since main.js
     is shared byte-for-byte between both and can't hardcode either
     path) -- the static site's pages are all flat siblings of sw.js,
     so the plain relative default already resolves correctly there. */
  if (!reduceMotion && "serviceWorker" in navigator) {
    navigator.serviceWorker.register(window.LDM_SW_URL || "sw.js").catch(function () {});
  }

  /* ----------------------------------------------------------------
     3D scene (Spline) — loaded through @splinetool/runtime's
     code-split "runtime.js" build (dozens of small chunk files
     fetched on demand), not its single-file "standalone" bundle —
     that large monolithic file consistently failed to import on at
     least one real device ("Importing a module script failed",
     Safari's generic wrapper for any module-load failure), where the
     code-split build — the same shape every bundler-based Spline site
     already serves in production — worked.

     Self-hosted entirely — the runtime, its WASM companions
     (physics.js/.wasm, hana-ui.js/.wasm), and the scene file itself
     (scene.splinecode) all live under assets/vendor/spline/, with
     `wasmPath` pointing there explicitly — so nothing at runtime
     depends on prod.spline.design or any other third-party CDN; the
     scene loads exactly as fast as any other same-origin asset.

     Skipped entirely under reduced motion (same rule as every other
     animated effect on this page). Starts loading immediately on
     page load — not gated on scroll proximity — since the runtime
     and scene assets are sizeable and the goal is for the scene to
     already be ready by the time a visitor scrolls down to it,
     rather than starting the fetch only once they're near it. Given
     a generous timeout so a slow-but-succeeding load isn't mistaken
     for a failure; if it genuinely hasn't resolved by then, the card
     is marked .is-failed so it never sits there indefinitely mid-spin.
     ---------------------------------------------------------------- */
  if (!reduceMotion) {
    var splineCanvas = document.querySelector("[data-spline-scene]");
    if (splineCanvas) {
      initSplineScene(splineCanvas);
    }
  }

  function initSplineScene(canvas) {
    var card = canvas.closest(".ldm-spline-card");
    var sceneUrl = canvas.getAttribute("data-spline-scene");

    /* The card shows a real still frame of the scene the whole time
       it's loading (see .ldm-spline-card's background-image in
       main.css) -- but that frame keeps showing indefinitely if the
       load ultimately fails, since only .is-loaded clears it. A
       transient network blip on a real mobile connection shouldn't
       permanently freeze the section on that still frame looking
       like it's supposed to be live and isn't responding, so retry
       once from scratch (a fresh Application/fetch, not reusing
       anything from the failed attempt) before actually giving up. */
    attempt(2);

    function attempt(attemptsLeft) {
      var settled = false;
      var app;

      var timeoutId = setTimeout(function () {
        if (settled) return;
        settled = true;
        onAttemptFailed();
      }, 30000);

      import("./vendor/spline/runtime.js")
        .then(function (mod) {
          if (settled) return null;
          /* Force the classic WebGL renderer explicitly. Left unset,
             the runtime auto-detects WebGPU support and, on a browser
             that has it, fetches an extra ~426KB WebGPU renderer
             chunk plus GPU-adapter negotiation on top of the WebGL
             renderer it still needs anyway -- pure added weight for a
             simple scene that doesn't use anything WebGPU-only. */
          app = new mod.Application(canvas, { wasmPath: "assets/vendor/spline", renderer: "webgl" });
          return app.load(sceneUrl);
        })
        .then(function () {
          if (settled) return;
          settled = true;
          clearTimeout(timeoutId);
          if (card) card.classList.add("is-loaded");
          setupVisibilityPause(app);
        })
        .catch(function () {
          if (settled) return;
          settled = true;
          clearTimeout(timeoutId);
          onAttemptFailed();
        });

      function onAttemptFailed() {
        if (attemptsLeft > 1) {
          attempt(attemptsLeft - 1);
        } else if (card) {
          card.classList.add("is-failed");
        }
      }
    }

    /* The render loop otherwise keeps running continuously even while
       this card is scrolled well out of view, competing with the
       rest of the page for GPU/main-thread time during scroll for no
       visible benefit. Application exposes stop()/play() specifically
       for this (stop() calls the renderer's setAnimationLoop(null) --
       a real halt, not just a visual pause), so pause it outside the
       viewport and resume it once it's back, the same pattern the
       hero's canvas network uses.

       Critical: don't stop() before the scene has been shown at
       least once. The scene loads eagerly on page load, well before
       the visitor has scrolled down to it -- if the very first
       IntersectionObserver callback (reporting "not intersecting
       yet") stopped the render loop immediately, the GPU's one-time
       shader-compile cost would get deferred until the exact moment
       it's scrolled into view and play() resumes it, turning an
       invisible background warm-up into a visible stall on first
       visit (confirmed: exactly this, gone on refresh once the
       driver's shader cache is warm). Letting it keep running until
       first shown preserves that quiet warm-up; only scroll-*away*
       afterwards pauses it. */
    function setupVisibilityPause(app) {
      if (!("IntersectionObserver" in window)) return;
      var everShown = false;
      var visIO = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!app) return;
            if (entry.isIntersecting) {
              everShown = true;
              app.play();
            } else if (everShown) {
              app.stop();
            }
          });
        },
        { rootMargin: "200px" }
      );
      visIO.observe(canvas);
    }
  }
})();
