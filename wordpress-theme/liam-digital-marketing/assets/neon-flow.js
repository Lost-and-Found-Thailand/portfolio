/* Neon Flow — ported from 21st.dev's "Neon Flow" component
   (@yashvw25/neon-flow), a cursor-reactive tube-and-light scene built
   on the same "threejs-components" cursor library the original React
   component itself dynamically imports from jsDelivr. Kept as a
   faithful, full-color port per explicit request rather than adapted
   to the site's usual black/lime palette — this is the one visual
   moment on the site that's allowed to be its own thing. Loaded only
   once this section nears the viewport (same lazy pattern as the
   Spline scene) since the underlying bundle is ~750KB. */
export function initNeonFlow(host) {
  var canvas = host.querySelector(".ldm-neon-flow-canvas");
  if (!canvas) return;

  import("https://cdn.jsdelivr.net/npm/threejs-components@0.0.19/build/cursors/tubes1.min.js")
    .then(function (mod) {
      var TubesCursor = mod.default;
      var app = TubesCursor(canvas, {
        tubes: {
          colors: ["#f967fb", "#53bc28", "#6958d5"],
          lights: { intensity: 200, colors: ["#83f36e", "#fe8a2e", "#ff008a", "#60aed5"] }
        }
      });
      host.classList.add("is-loaded");
      host.addEventListener("click", function () {
        app.tubes.setColors(randomColors(3));
        app.tubes.setLightsColors(randomColors(4));
      });
    })
    .catch(function () {
      host.classList.add("is-failed");
    });
}

function randomColors(count) {
  var out = [];
  for (var i = 0; i < count; i++) {
    out.push("#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, "0"));
  }
  return out;
}
