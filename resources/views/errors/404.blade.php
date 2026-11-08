{{-- resources/views/errors/404.blade.php --}}
{{--
    CULTARK "BRB" 404 page.
    Extracted from the static prototype `404-page.html`: the Snake mini-game
    (canvas + JS), its styles, and the site links were pulled out of that file
    and rebuilt as a self-contained Blade view.

    Notes:
      * The prototype's hero section was a 3 MB inline base64 PNG. It is not
        part of the game, so it is referenced via asset('img/404-hero.png') —
        drop the exported image at public/img/404-hero.png to restore it.
      * Internal links use url() / route() helpers where sensible; they fall
        back to the app URL if your routes are named differently.
--}}
@php
    // Prefer a named 'home' route; fall back to the app root. Contact anchor
    // mirrors the prototype's staging link (#getInTouch).
    $homeUrl    = function_exists('route') && class_exists(\Illuminate\Support\Facades\Route::class) && \Illuminate\Support\Facades\Route::has('home')
                    ? route('home')
                    : (function_exists('url') ? url('/') : '/');
    $contactUrl = rtrim($homeUrl, '/') . '/#getInTouch';
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CULTARK — 404. BRB. Making a scene.</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#11120f;color:#fff9eb;font-family:Arial,Helvetica,sans-serif}button,a{font:inherit}button{cursor:pointer}button:focus-visible,a:focus-visible{outline:3px solid #dcff00;outline-offset:5px}.hero{position:relative;max-width:1800px;margin:auto}.hero img{width:100%;display:block}.hot{position:absolute;display:block;z-index:1}.home{left:4.8%;top:43.1%;width:17.3%;height:6%}.navhome{left:79%;top:3%;width:6%;height:4%}.contact{left:88%;top:3%;width:10%;height:4%}.playbar{padding:24px 5%;display:flex;justify-content:space-between;align-items:center;gap:20px;border-top:1px solid #ffffff25;background:#181a16}.playbar p{margin:0;color:#c1c4b9}.play{background:#d8ff00;color:#13140f;border:0;padding:16px 24px;font-weight:800}.play:hover{background:#fff9eb}.play span{margin-left:20px}dialog{padding:0;border:1px solid #6767ff;background:#2015ed;color:#fff9eb;width:min(960px,95vw);max-height:95dvh;overflow:auto}dialog::backdrop{background:#000c;backdrop-filter:blur(8px)}.game{padding:24px}.top{display:flex;justify-content:space-between;align-items:center}.close{background:transparent;color:inherit;border:1px solid #ffffff66;padding:8px 12px}h1{font-size:clamp(32px,5vw,60px);line-height:.95;letter-spacing:-2px;margin:24px 0 12px}h1 span{color:#d8ff00}.sub{margin:0 0 20px}.score{display:flex;justify-content:space-between;font:13px monospace;margin-bottom:10px}.board{position:relative;max-width:520px;margin:auto}canvas{display:block;width:100%;aspect-ratio:1;background:#130f88;touch-action:none;border:1px solid #ffffff66}.overlay{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;background:#100b77d9;text-align:center;padding:20px}.overlay[hidden]{display:none}.overlay h2{font-size:28px;max-width:360px}.actions{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:16px auto 0;max-width:520px}.pause{background:transparent;color:white;border:1px solid white;padding:10px 16px}.pad{display:grid;grid-template-columns:repeat(3,48px);gap:6px;justify-content:center;margin-top:18px}.pad button{background:#ffffff15;color:white;border:1px solid #ffffff70;min-height:44px}.hint{text-align:center;font-size:12px;opacity:.8;margin-top:18px}@media(max-width:600px){.hero{overflow:hidden}.hero img{width:180%;max-width:none;transform:translateX(-5%)}.home{left:3.6%;top:43%;width:31%;height:6%}.navhome,.contact{display:none}.playbar{flex-direction:column;align-items:stretch}.game{padding:18px}.sub{font-size:14px}}

        dialog{width:min(1320px,97vw);max-height:96dvh;border:0;border-radius:30px;background:#2010e8}.game{padding:26px 30px 20px}.top{margin-bottom:34px}.brand{font-size:30px;letter-spacing:-1px}.top nav{display:flex;align-items:center;gap:30px}.top a{color:#fff9eb;text-decoration:none;font-weight:800;font-size:15px}.close{border:0;font-size:26px;padding:0 8px}.layout{display:grid;grid-template-columns:.91fr 1.09fr;gap:24px;align-items:center}.intro h1{font-family:Impact,'Arial Narrow',Arial,sans-serif;font-size:clamp(52px,7.4vw,102px);font-weight:900;letter-spacing:-3px;line-height:.94;margin:0 0 24px}.intro h1>span{color:#d8ff00;white-space:nowrap}.dot{color:#fff9eb}.sub{font-size:clamp(17px,2vw,26px);line-height:1.25;margin:0}.intro #status{font-size:13px;min-height:18px;margin-top:22px;opacity:.75}.frame{border:2px solid #fff9eb}.score{padding:12px 15px;margin:0;border-bottom:2px solid #fff9eb;font:bold 19px Arial;align-items:center}.score b{color:#d8ff00;font-size:28px;margin-left:8px}.score .best{font-size:11px;opacity:.75}.score .best b{font-size:14px}.board{max-width:none}.board canvas{border:0;aspect-ratio:1.4;width:100%;height:auto;background:#1b0cc4}.overlay{pointer-events:none;background:#160c98d9}.controlbar{border-top:2px solid #fff9eb;display:flex;align-items:center;padding:12px;gap:12px;flex-wrap:wrap}.controlbar .play{background:#fff9eb;color:#2010e8;padding:10px 18px;font-size:17px}.pad{display:flex;gap:5px;margin:0}.pad button{min-height:30px;width:30px;padding:0;font-size:22px;border-radius:4px;background:none}.keyhint{font-size:10px;font-weight:bold}.pause{padding:5px 8px;font-size:14px;margin-left:auto}footer{border-top:1px solid #fff9eb;margin-top:30px;padding-top:15px;font-size:12px;font-weight:bold;letter-spacing:1.8px}footer i{font-style:normal;margin:0 12px;color:#d8ff00}@media(max-width:700px){dialog{border-radius:20px}.game{padding:20px 18px}.top{margin-bottom:24px}.brand{font-size:23px}.top nav{gap:14px}.top a{font-size:11px}.layout{grid-template-columns:1fr}.intro h1{font-size:clamp(55px,12vw,82px);letter-spacing:-2px}.sub{font-size:18px}.intro #status{margin:10px 0 0}.controlbar{gap:8px}.controlbar .play{font-size:14px;padding:10px}.keyhint{display:none}.pad button{width:36px;min-height:42px}footer{font-size:9px;line-height:1.8;letter-spacing:1px}footer i{margin:0 4px}.score{font-size:16px}.score b{font-size:23px}}
    </style>
</head>
<body>
<main>
    {{-- Hero: swap in the exported PNG at public/img/404-hero.png to restore
         the original art (it was a 3MB inline base64 blob in the prototype).
         If the image is missing, onerror hides it and the page still works. --}}
    <section class="hero">
        <img src="{{ asset('img/404-hero.png') }}" alt="CULTARK. 404. BRB. Making a scene. This page is still in the studio. We’ll be right back. Cinematic Cairo office with an empty chair." onerror="this.style.display='none'">
        <a class="hot home" href="{{ $homeUrl }}" aria-label="Back to home"></a>
        <a class="hot navhome" href="{{ $homeUrl }}" aria-label="Home"></a>
        <a class="hot contact" href="{{ $contactUrl }}" aria-label="Let's talk"></a>
    </section>

    <section class="playbar">
        <p>Error 404 — this page wandered off. While we make a scene, you can grow something.</p>
        <button class="play" id="open">PLAY SNAKE <span>↗</span></button>
    </section>
</main>

<dialog id="modal" aria-labelledby="title">
    <div class="game">
        <header class="top">
            <b class="brand">CULTARK✱</b>
            <nav>
                <a href="{{ $homeUrl }}">HOME</a>
                <a href="{{ $contactUrl }}">LET’S TALK</a>
                <button class="close" id="close" aria-label="Back to studio">×</button>
            </nav>
        </header>

        <div class="layout">
            <section class="intro">
                <h1 id="title">PAGE NOT<br>FOUND.<br><span>STILL GROWING<span class="dot">.</span></span></h1>
                <p class="sub">We’re working on this page.<br>Grow something while you wait.</p>
                <p id="status" role="status" aria-live="polite">Ready when you are.</p>
            </section>

            <section class="frame">
                <div class="score">
                    <span>YOUR GROWTH: <b id="score">000</b></span>
                    <span class="best">BEST: <b id="best">000</b></span>
                </div>
                <div class="board">
                    <canvas id="canvas" width="520" height="520" aria-label="Snake game. Use arrow keys or WASD, swipe, or direction buttons."></canvas>
                    <div class="overlay" id="overlay" hidden><h2 id="message"></h2></div>
                </div>
                <div class="controlbar">
                    <button class="play" id="start">LET’S PLAY</button>
                    <div class="pad" aria-label="Direction controls">
                        <button data-dir="up" aria-label="Up">↑</button>
                        <button data-dir="down" aria-label="Down">↓</button>
                        <button data-dir="left" aria-label="Left">←</button>
                        <button data-dir="right" aria-label="Right">→</button>
                    </div>
                    <span class="keyhint">ARROW KEYS TO MOVE</span>
                    <button class="pause" id="pause" aria-label="Pause game">Ⅱ</button>
                </div>
            </section>
        </div>

        <footer>CAIRO BORN <i>•</i> RESULTS POWERED <i>•</i> CULTURE DRIVEN</footer>
    </div>
</dialog>

<script>
const $=id=>document.getElementById(id),ctx=$('canvas').getContext('2d'),N=20,C=26;let snake,food,dir,next,score=0,best=0,timer=null,running=false,paused=false,queued=false;try{best=Number(localStorage.getItem('cultarkSnakeBest'))||0}catch{}$('best').textContent=String(best).padStart(3,'0');
function spawn(){const empty=[];for(let y=0;y<N;y++)for(let x=0;x<N;x++)if(!snake.some(s=>s.x===x&&s.y===y))empty.push({x,y});return empty[Math.floor(Math.random()*empty.length)]}
function draw(){ctx.fillStyle='#1b0cc4';ctx.fillRect(0,0,520,520);ctx.strokeStyle='#ffffff35';for(let i=0;i<=N;i++){ctx.beginPath();ctx.moveTo(i*C,0);ctx.lineTo(i*C,520);ctx.moveTo(0,i*C);ctx.lineTo(520,i*C);ctx.stroke()}snake.forEach((s,i)=>{ctx.fillStyle=i?'#d8ff00':'#f6ff9b';ctx.fillRect(s.x*C+1,s.y*C+1,C-2,C-2)});const head=snake[0];ctx.fillStyle='#2010e8';ctx.fillRect(head.x*C+6,head.y*C+6,5,5);ctx.fillRect(head.x*C+16,head.y*C+6,5,5);if(food){ctx.save();ctx.translate(food.x*C+C/2,food.y*C+C/2);ctx.strokeStyle='#fff9eb';ctx.lineWidth=4;for(let a=0;a<4;a++){ctx.rotate(Math.PI/4);ctx.beginPath();ctx.moveTo(-9,0);ctx.lineTo(9,0);ctx.stroke()}ctx.restore()}}
function reset(){snake=[{x:8,y:10},{x:7,y:10},{x:6,y:10}];dir={x:1,y:0};next=dir;queued=false;score=0;food=spawn();$('score').textContent='000';draw()}function stop(){clearInterval(timer);timer=null}function schedule(){stop();timer=setInterval(tick,Math.max(75,155-score*4))}
function finish(win=false){stop();running=false;$('overlay').hidden=false;$('message').textContent=win?'You grew into every corner.':'Growth isn’t always a straight line.';$('start').textContent='GO AGAIN';$('status').textContent='Final growth: '+score}
function tick(){dir=next;queued=false;const h={x:snake[0].x+dir.x,y:snake[0].y+dir.y},eat=h.x===food.x&&h.y===food.y;const body=eat?snake:snake.slice(0,-1);if(h.x<0||h.x>=N||h.y<0||h.y>=N||body.some(s=>s.x===h.x&&s.y===h.y)){finish();return}snake.unshift(h);if(eat){score++;$('score').textContent=String(score).padStart(3,'0');if(score>best){best=score;$('best').textContent=String(best).padStart(3,'0');try{localStorage.setItem('cultarkSnakeBest',best)}catch{}}food=spawn();if(!food){draw();finish(true);return}schedule()}else snake.pop();draw()}
function start(){reset();running=true;paused=false;$('pause').textContent='Ⅱ';$('start').textContent='RESTART';$('overlay').hidden=true;$('status').textContent='Keep growing.';schedule()}
function pause(){if(!running)return;paused=!paused;$('pause').textContent=paused?'▶':'Ⅱ';$('status').textContent=paused?'Take your time.':'Keep growing.';if(paused)stop();else schedule()}
const dirs={up:{x:0,y:-1},down:{x:0,y:1},left:{x:-1,y:0},right:{x:1,y:0}};function turn(d){if(!running||paused||queued)return;const v=dirs[d];if(v.x===-dir.x&&v.y===-dir.y)return;next=v;queued=true}
$('open').onclick=()=>{$('modal').showModal();document.body.style.overflow='hidden'};$('close').onclick=()=>$('modal').close();$('modal').addEventListener('close',()=>{stop();running=false;paused=false;document.body.style.overflow='';$('overlay').hidden=true;reset();$('status').textContent='Ready when you are.';$('start').textContent='LET’S PLAY';$('open').focus()});$('start').onclick=start;$('pause').onclick=pause;document.querySelectorAll('[data-dir]').forEach(b=>b.onclick=()=>turn(b.dataset.dir));document.addEventListener('keydown',e=>{if(!$('modal').open)return;const k={ArrowUp:'up',w:'up',ArrowDown:'down',s:'down',ArrowLeft:'left',a:'left',ArrowRight:'right',d:'right'}[e.key];if(k){e.preventDefault();turn(k)}if(e.code==='Space'&&e.target.tagName!=='BUTTON'){e.preventDefault();pause()}});let touch=null;$('canvas').addEventListener('pointerdown',e=>{touch={x:e.clientX,y:e.clientY};$('canvas').setPointerCapture(e.pointerId)});$('canvas').addEventListener('pointerup',e=>{if(!touch)return;const x=e.clientX-touch.x,y=e.clientY-touch.y;touch=null;if(Math.max(Math.abs(x),Math.abs(y))<10)return;turn(Math.abs(x)>Math.abs(y)?(x>0?'right':'left'):(y>0?'down':'up'))});document.addEventListener('visibilitychange',()=>{if(document.hidden&&running&&!paused)pause()});reset();
</script>
</body>
</html>
