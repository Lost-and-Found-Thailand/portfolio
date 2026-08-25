/* Contact CTA ripple — adapted from 21st.dev's "Shader Animation"
   component (@designali-in/shader-animation), which renders concentric
   fractal ripple rings via a Three.js fragment shader. Ported to a
   hand-rolled WebGL1 shader (no Three.js — the effect itself is one
   fragment shader, not worth a 3D-engine dependency for) and recolored:
   the original outputs three independently-phased RGB channels for a
   rainbow/chromatic-aberration look, which would clash hard with this
   site's black-and-lime palette, so this keeps the same ring-
   accumulation math but collapses it to a single channel tinted only
   with --color-accent over --color-black. Echoes the same signal/ripple
   motif already used for the case-card ACTIVATE ripple and the pulsing
   status dot elsewhere on the site, rather than introducing a new,
   unrelated visual language. Lazy-loaded and paused off-screen (see
   main.js) so it costs nothing until — and unless — it's actually seen. */
export function initShaderRipple(section) {
  var canvas = document.createElement("canvas");
  canvas.className = "ldm-contact-shader";
  canvas.setAttribute("aria-hidden", "true");
  section.insertBefore(canvas, section.firstChild);

  var gl = canvas.getContext("webgl", { alpha: false, antialias: false, powerPreference: "low-power" });
  if (!gl) return;

  var vertSrc = "attribute vec2 aPos;void main(){gl_Position=vec4(aPos,0.0,1.0);}";
  var fragSrc = [
    "precision highp float;",
    "uniform vec2 uResolution;",
    "uniform float uTime;",
    "void main(void) {",
    "  vec2 uv = (gl_FragCoord.xy * 2.0 - uResolution.xy) / min(uResolution.x, uResolution.y);",
    "  float t = uTime * 0.05;",
    "  float lineWidth = 0.0007;",
    "  float rings = 0.0;",
    "  for (int i = 0; i < 3; i++) {",
    "    float fi = float(i);",
    "    rings += lineWidth * fi * fi / abs(fract(t + fi * 0.01) * 5.0 - length(uv) + mod(uv.x + uv.y, 0.6));",
    "  }",
    "  vec2 edgeUv = gl_FragCoord.xy / uResolution;",
    "  float edgeFade = smoothstep(0.0, 0.14, edgeUv.x) * smoothstep(0.0, 0.14, 1.0 - edgeUv.x)",
    "                  * smoothstep(0.0, 0.22, edgeUv.y) * smoothstep(0.0, 0.22, 1.0 - edgeUv.y);",
    "  float centerFade = smoothstep(0.1, 0.85, length(uv));",
    "  float intensity = clamp(rings, 0.0, 1.0) * 0.4 * centerFade * edgeFade;",
    "  vec3 base = vec3(0.00784, 0.00784, 0.00392);",
    "  vec3 accent = vec3(0.784, 1.0, 0.0);",
    "  gl_FragColor = vec4(base + accent * intensity, 1.0);",
    "}"
  ].join("\n");

  function compile(type, src) {
    var s = gl.createShader(type);
    gl.shaderSource(s, src);
    gl.compileShader(s);
    return s;
  }

  var program = gl.createProgram();
  gl.attachShader(program, compile(gl.VERTEX_SHADER, vertSrc));
  gl.attachShader(program, compile(gl.FRAGMENT_SHADER, fragSrc));
  gl.linkProgram(program);
  if (!gl.getProgramParameter(program, gl.LINK_STATUS)) return;
  gl.useProgram(program);

  var buf = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
  var aPos = gl.getAttribLocation(program, "aPos");
  gl.enableVertexAttribArray(aPos);
  gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);

  var uRes = gl.getUniformLocation(program, "uResolution");
  var uTime = gl.getUniformLocation(program, "uTime");
  var dpr = Math.min(window.devicePixelRatio || 1, 1.5);
  var rafId = null;
  var startTime = null;

  function resize() {
    var w = section.clientWidth, h = section.clientHeight;
    canvas.width = Math.max(1, Math.round(w * dpr));
    canvas.height = Math.max(1, Math.round(h * dpr));
    gl.viewport(0, 0, canvas.width, canvas.height);
  }
  resize();
  window.addEventListener("resize", resize);

  function frame(t) {
    if (startTime === null) startTime = t;
    gl.uniform2f(uRes, canvas.width, canvas.height);
    gl.uniform1f(uTime, (t - startTime) / 1000);
    gl.drawArrays(gl.TRIANGLES, 0, 3);
    rafId = requestAnimationFrame(frame);
  }
  function play() { if (rafId === null) rafId = requestAnimationFrame(frame); }
  function stop() { if (rafId !== null) { cancelAnimationFrame(rafId); rafId = null; } }

  play();

  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) play();
          else stop();
        });
      },
      { rootMargin: "200px" }
    );
    io.observe(section);
  }
}
