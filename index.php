<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terra Girando com Manchetes</title>
  <style> 
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      min-height: 100svh;
      background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
      font-family: Arial, sans-serif;
      overflow: hidden;
    }

    .container {
      text-align: center;
      position: relative;
      width: min(800px, 92vw);
      max-width: 100%;
    }

    canvas {
      display: block;
      width: 100%;
      height: auto;
      border-radius: 50%;
      box-shadow: 0 0 50px rgba(100, 149, 237, 0.3),
        0 0 100px rgba(100, 149, 237, 0.2),
        inset 0 0 30px rgba(0, 0, 0, 0.3);
      animation: float 6s ease-in-out infinite;
      cursor: grab;
      user-select: none;
      touch-action: none;
    }

    canvas:active {
      cursor: grabbing;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) scale(1);
      }

      50% {
        transform: translateY(-10px) scale(1.02);
      }
    }

    .stars {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .star {
      position: absolute;
      background: white;
      border-radius: 50%;
      animation: twinkle 3s infinite alternate;
    }

    @keyframes twinkle {
      0% {
        opacity: 0.3;
      }

      100% {
        opacity: 1;
      }
    }

    .label {
      position: fixed;
      color: #FFD700;
      background: rgba(0, 0, 0, 0.85);
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 14px;
      width: 280px;
      max-width: calc(100vw - 24px);
      white-space: normal;
      word-wrap: break-word;
      overflow: visible;
      animation: pulse 4s infinite;
      text-align: left;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
      z-index: 5;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 0.9;
      }

      50% {
        transform: scale(1.05);
        opacity: 1;
      }

      100% {
        transform: scale(1);
        opacity: 0.9;
      }
    }

    .info {
      color: white;
      margin-top: 30px;
      font-size: 14px;
      opacity: 0.8;
    }

    .moon-button {
      position: fixed;
      top: 0;
      left: 0;
      width: 100px;
      height: 100px;
      background: transparent url('lua_fundo_transparente.avif') no-repeat center center / contain;
      border: none;
      cursor: pointer;
      z-index: 4;
      filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.45));
    }

    .label a {
      pointer-events: auto;
      color: inherit;
      max-width: 300px;
      text-overflow: ellipsis;
      text-decoration: none;
    }

    .label a:hover {
      text-decoration: underline;
    }

    .satellite-buttons {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      gap: 15px;
      z-index: 2;
    }


    .satellite-button {
      width: 60px;
      height: 60px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .satellite-button:hover {
      transform: scale(1.2);
      box-shadow: 0 0 10px rgba(0, 200, 255, 0.7);
    }


    .btn {
      background-color: #2c77ff;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #1a5ad7;
    }

    .satellite-button {
      position: fixed;
      width: 60px;
      height: 60px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      z-index: 2;
    }

    .fixed-buttons {
      position: fixed;
      top: 50%;
      right: 20px;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 15px;
      z-index: 999;
    }

    .fixed-buttons button {
      background: transparent;
      border: 2px solid #00d4ff;
      color: #00d4ff;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .fixed-buttons button:hover {
      background-color: rgba(0, 212, 255, 0.1);
      transform: scale(1.05);
    }

    .voice-select {
      width: 180px;
      background: rgba(0, 0, 0, 0.45);
      border: 2px solid #00d4ff;
      color: #00d4ff;
      padding: 8px 10px;
      border-radius: 8px;
      font-size: 13px;
      outline: none;
      cursor: pointer;
    }

    .voice-select option {
      color: #111;
    }

    .voice-status {
      width: 180px;
      box-sizing: border-box;
      background: rgba(0, 0, 0, 0.45);
      border: 1px solid rgba(0, 212, 255, 0.55);
      border-radius: 8px;
      padding: 6px 8px;
      color: #c9f6ff;
      font-size: 12px;
      line-height: 1.2;
      text-align: center;
      opacity: 1;
    }

    @media (max-width: 768px) {
  .container {
    width: min(92vw, 640px);
  }

  .label {
    font-size: 12px;
    width: min(210px, calc(100vw - 24px));
    padding: 4px 8px;
  }

  .info {
    font-size: 12px;
    margin-top: 20px;
  }

  .moon-button {
    width: 60px;
    height: 60px;
  }

  .satellite-button {
    width: 42px;
    height: 42px;
  }

  .fixed-buttons button {
    font-size: 12px;
    padding: 8px 16px;
  }
}

@media (max-width: 480px) {
  body {
    align-items: flex-start;
    padding-top: max(18px, env(safe-area-inset-top));
  }

  .container {
    width: min(94vw, 390px);
  }

  .label {
    width: min(168px, calc(100vw - 20px));
    font-size: 11px;
    line-height: 1.15;
  }

  .moon-button {
    width: 52px;
    height: 52px;
  }

  .fixed-buttons {
    right: 10px;
    top: auto;
    bottom: calc(76px + env(safe-area-inset-bottom));
    transform: none;
    gap: 10px;
  }

  .fixed-buttons button {
    padding: 6px 12px;
    font-size: 11px;
  }

  .voice-select {
    width: 132px;
    font-size: 11px;
    padding: 6px 8px;
  }

  .voice-status {
    width: 132px;
    font-size: 10px;
    padding: 5px 6px;
  }

  .info {
    margin-top: 14px;
    line-height: 1.25;
  }
}


  </style>
</head>

<body>
  <div class="stars" id="stars"></div>
  <div class="container">
  <canvas id="earthCanvas" width="800" height="800" style="max-width: 100%; height: auto;"></canvas>
  <div class="info">
      🌍 Planeta Terra • Rotação: 24 horas<br>
      <small>☕ Arraste para girar • 🔊 Toque e arraste no celular</small>
    </div>
    <button type="button" class="moon-button" title="Ouvir Manchetes"></button>

    <?php
    function carregarRSS($url)
    {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $data = curl_exec($ch);
      curl_close($ch);
      if (!$data)
        return null;
      return @simplexml_load_string($data);
    }

    function tempoDecorrido($timestamp)
    {
      $agora = time();
      $diferenca = $agora - $timestamp;
      if ($diferenca < 60)
        return 'há poucos segundos';
      if ($diferenca < 3600)
        return 'há ' . floor($diferenca / 60) . ' minutos';
      if ($diferenca < 86400)
        return 'há ' . floor($diferenca / 3600) . ' horas';
      return 'há ' . floor($diferenca / 86400) . ' dias';
    }

    function pegarNoticiasRSS($feeds)
    {
      $noticias = [];
      foreach ($feeds as $url) {
        $rss = carregarRSS($url);
        if (!$rss || !isset($rss->channel->item))
          continue;
        foreach ($rss->channel->item as $item) {
          $noticias[] = [
            'titulo' => (string) $item->title,
            'link' => (string) $item->link,
            'data' => strtotime((string) $item->pubDate ?? 'now'),
          ];
        }
      }
      usort($noticias, fn($a, $b) => $b['data'] - $a['data']);
      return array_slice($noticias, 0, 10);
    }

    $feeds = [
      'CNN Brasil' => 'https://admin.cnnbrasil.com.br/feed/',
      'ISTOÉ' => 'https://istoe.com.br/feed/',
      'G1' => 'https://g1.globo.com/dynamo/rss2.xml',
      'Folha' => 'https://feeds.folha.uol.com.br/emcimadahora/rss091.xml',
      'BBC Brasil' => 'https://www.bbc.com/portuguese/index.xml',
      'Estadão' => 'https://feeds.folha.uol.com.br/poder/rss091.xml',
      'New York Times' => 'https://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml',
      'The Guardian' => 'https://www.theguardian.com/world/rss',
      'Al Jazeera' => 'https://www.aljazeera.com/xml/rss/all.xml',

      // Fontes adicionais
      'Veja' => 'https://veja.abril.com.br/rss',
      'Super Interessante' => 'https://super.abril.com.br/feed/',
      'InfoMoney' => 'https://www.infomoney.com.br/feed/',
      'Exame' => 'https://exame.com/feed/',
      'Nexo Jornal' => 'https://www.nexojornal.com.br/rss.xml',
      'Agência Brasil' => 'https://agenciabrasil.ebc.com.br/rss.xml',
      'Rádio Jovem Pan' => 'https://jovempan.com.br/feed',


      'CBC News' => 'http://rss.cbc.ca/lineup/world.xml',
      'NBC News World' => 'http://feeds.nbcnews.com/feeds/worldnews',
      'CNN World' => 'http://rss.cnn.com/rss/edition_world.rss',
      'Economist' => 'https://www.economist.com/international/rss.xml',
      'TechCrunch' => 'https://techcrunch.com/feed/',
      'Wired' => 'https://www.wired.com/feed/rss',
      'BuzzFeed News' => 'https://www.buzzfeed.com/world.xml',
      'Science Daily' => 'https://www.sciencedaily.com/rss/top/science.xml',


    ];

    $noticias = pegarNoticiasRSS($feeds);
    echo "<script>const noticiasIniciais = " . json_encode($noticias) . ";</script>";

    foreach ($noticias as $i => $n) {
      $tempo = tempoDecorrido($n['data']);
      $cor = ($i === 0) ? '#FFD700' : 'white';
      echo "<div class='label' id='label$i'><a href='" . htmlspecialchars($n['link']) . "' target='_blank' style='color:$cor;'>" . htmlspecialchars($n['titulo']) . " <small>($tempo)</small></a></div>";
    }
    ?>
  </div>

  <div id="sat1" class="satellite-button"
    style="background-image: url('https://pngimg.com/uploads/satellite/satellite_PNG17.png');">
  </div>
  <div id="sat2" class="satellite-button"
    style="background-image: url('https://pngimg.com/uploads/satellite/satellite_PNG14.png');">
  </div>
  <div id="sat3" class="satellite-button"
    style="background-image: url('https://pngimg.com/uploads/satellite/satellite_PNG33.png');">
  </div>




  <div class="fixed-buttons">
    <select id="voiceSelect" class="voice-select" aria-label="Voz" autocomplete="off">
      <option value="pt-BR-AntonioNeural" selected>Antonio Neural</option>
      <option value="pt-BR-FranciscaNeural">Francisca Neural</option>
      <option value="pt-BR-ThalitaMultilingualNeural">Thalita Neural</option>
    </select>
    <div id="voiceStatus" class="voice-status">Antonio Neural</div>
    <button onclick="window.location.href='noticias.php'">📰 Notícias</button>
    <button onclick="window.location.href='sobre.php'">ℹ️ Sobre</button>
  </div>




  <script>
    const canvas = document.getElementById('earthCanvas');
    const ctx = canvas.getContext('2d');
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = 370;
    let rotation = 0;
    let isDragging = false;
    let lastMouseX = 0;
    let earthImage = new Image();
    earthImage.crossOrigin = 'anonymous';
    earthImage.src = 'https://i0.wp.com/narceliodesa.com/wp-content/uploads/2019/10/11.jpg?fit=750%2C410&ssl=1';

    const ttsEndpoint = 'api/tts/';
    const voiceSelect = document.getElementById('voiceSelect');
    const voiceStatus = document.getElementById('voiceStatus');
    let currentAudio = null;
    const labels = Array.from({ length: 10 }, (_, i) => document.getElementById('label' + i)).filter(Boolean);
    const labelRadius = radius + 120;

    function clamp(value, min, max) {
      return Math.min(Math.max(value, min), max);
    }

    function getCanvasMetrics() {
      const rect = canvas.getBoundingClientRect();
      const scale = rect.width / canvas.width;

      return {
        rect,
        scale,
        centerX: rect.left + rect.width / 2,
        centerY: rect.top + rect.height / 2,
        radius: radius * scale
      };
    }

    function getVisibleLabelCount() {
      if (window.innerWidth <= 480) return 7;
      if (window.innerWidth <= 768) return 6;
      return labels.length;
    }

    function createStars() {
      const starsContainer = document.getElementById('stars');
      for (let i = 0; i < 100; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.width = star.style.height = (Math.random() * 3 + 1) + 'px';
        star.style.animationDelay = Math.random() * 3 + 's';
        starsContainer.appendChild(star);
      }
    }

    function drawEarth() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.save();
      ctx.beginPath();
      ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
      ctx.clip();
      const imgW = radius * 2.5;
      const offsetX = (rotation * 100) % imgW;
      ctx.translate(centerX, centerY);
      ctx.drawImage(earthImage, -offsetX - imgW / 2, -imgW / 2, imgW, imgW);
      ctx.drawImage(earthImage, -offsetX + imgW / 2, -imgW / 2, imgW, imgW);
      ctx.restore();

      const gradient = ctx.createRadialGradient(centerX, centerY, radius * 0.8, centerX, centerY, radius * 1.2);
      gradient.addColorStop(0, 'rgba(100, 149, 237, 0)');
      gradient.addColorStop(1, 'rgba(100, 149, 237, 0.4)');
      ctx.fillStyle = gradient;
      ctx.beginPath();
      ctx.arc(centerX, centerY, radius * 1.2, 0, Math.PI * 2);
      ctx.fill();
    }

    function animate() {
      if (!isDragging) rotation += 0.005;
      drawEarth();
      const metrics = getCanvasMetrics();
      const visibleLabelCount = getVisibleLabelCount();

      labels.forEach((label, i) => {
        if (i >= visibleLabelCount) {
          label.style.display = 'none';
          return;
        }

        label.style.display = 'block';
        const angle = -rotation + i * ((2 * Math.PI) / visibleLabelCount);
        const orbitX = Math.min(
          labelRadius * metrics.scale,
          Math.max(0, (window.innerWidth - label.offsetWidth - 24) / 2)
        );
        const orbitY = Math.min(
          labelRadius * metrics.scale * 0.6,
          window.innerHeight * (window.innerWidth <= 480 ? 0.2 : 0.35)
        );
        const x = metrics.centerX + orbitX * Math.cos(angle);
        const y = metrics.centerY + orbitY * Math.sin(angle);
        const left = clamp(x - label.offsetWidth / 2, 8, window.innerWidth - label.offsetWidth - 8);
        const top = clamp(y - label.offsetHeight / 2, 8, window.innerHeight - label.offsetHeight - 8);

        label.style.left = `${left}px`;
        label.style.top = `${top}px`;
      });
      requestAnimationFrame(animate);
    }

    canvas.addEventListener('mousedown', (e) => {
      if (e.target.tagName.toLowerCase() === 'a') return;
      isDragging = true;
      lastMouseX = e.clientX;
    });

    canvas.addEventListener('mousemove', (e) => {
      if (isDragging) {
        const deltaX = e.clientX - lastMouseX;
        rotation += deltaX * 0.01;
        lastMouseX = e.clientX;
      }
    });

    canvas.addEventListener('mouseup', () => { isDragging = false; });
    canvas.addEventListener('mouseleave', () => { isDragging = false; });

    canvas.addEventListener('touchstart', (e) => {
      if (e.target.tagName.toLowerCase() === 'a') return;
      isDragging = true;
      lastMouseX = e.touches[0].clientX;
    });

    canvas.addEventListener('touchmove', (e) => {
      if (isDragging) {
        const deltaX = e.touches[0].clientX - lastMouseX;
        rotation += deltaX * 0.01;
        lastMouseX = e.touches[0].clientX;
      }
    });

    canvas.addEventListener('touchend', () => { isDragging = false; });

    function getSelectedVoice() {
      return voiceSelect?.value || 'pt-BR-AntonioNeural';
    }

    function getSelectedVoiceLabel() {
      return voiceSelect?.selectedOptions?.[0]?.textContent || 'Antonio Neural';
    }

    function setSelectedVoice(voice) {
      if (!voiceSelect) return;
      const hasVoice = Array.from(voiceSelect.options).some(option => option.value === voice);
      voiceSelect.value = hasVoice ? voice : 'pt-BR-AntonioNeural';
      updateVoiceStatus(getSelectedVoiceLabel());
    }

    function updateVoiceStatus(text) {
      if (voiceStatus) {
        voiceStatus.textContent = text;
      }
    }

    if (voiceSelect) {
      setSelectedVoice(localStorage.getItem('newsVoice') || 'pt-BR-AntonioNeural');
      voiceSelect.addEventListener('change', () => {
        localStorage.setItem('newsVoice', getSelectedVoice());
        updateVoiceStatus(getSelectedVoiceLabel());
      });
    } else {
      updateVoiceStatus(getSelectedVoiceLabel());
    }

    function stopCurrentAudio() {
      if (!currentAudio) return;
      currentAudio.pause();
      currentAudio.currentTime = 0;
      if (currentAudio.dataset.url) {
        URL.revokeObjectURL(currentAudio.dataset.url);
      }
      currentAudio = null;
    }

    async function playTts(text, cancelCurrent = true) {
      if (cancelCurrent) {
        stopCurrentAudio();
      }

      try {
        const form = new FormData();
        form.append('text', text);
        form.append('voice', getSelectedVoice());

        updateVoiceStatus('Gerando ' + getSelectedVoiceLabel());

        const response = await fetch(ttsEndpoint, {
          method: 'POST',
          body: form
        });

        if (!response.ok) {
          const errorText = await response.text();
          console.warn('TTS neural indisponivel:', errorText);
          let errorMessage = 'Neural indisponivel';
          try {
            const errorJson = JSON.parse(errorText);
            if (errorJson.error) {
              errorMessage = errorJson.error.includes('AZURE_SPEECH_KEY')
                ? 'Configure a chave Azure'
                : errorJson.error;
            }
          } catch (error) {
            // Mantem a mensagem curta quando a resposta nao vier em JSON.
          }
          updateVoiceStatus(errorMessage);
          return false;
        }

        const blob = await response.blob();
        if (!blob || !blob.size) {
          updateVoiceStatus('Audio neural vazio');
          return false;
        }

        const audioUrl = URL.createObjectURL(blob);
        const audio = new Audio(audioUrl);
        audio.dataset.url = audioUrl;
        currentAudio = audio;

        return await new Promise((resolve) => {
          audio.addEventListener('ended', () => {
            URL.revokeObjectURL(audioUrl);
            if (currentAudio === audio) currentAudio = null;
            updateVoiceStatus(getSelectedVoiceLabel());
            resolve(true);
          }, { once: true });

          audio.addEventListener('error', () => {
            URL.revokeObjectURL(audioUrl);
            if (currentAudio === audio) currentAudio = null;
            updateVoiceStatus('Nao consegui tocar neural');
            resolve(false);
          }, { once: true });

          audio.play().catch((error) => {
            console.warn('Falha ao tocar audio neural:', error);
            URL.revokeObjectURL(audioUrl);
            if (currentAudio === audio) currentAudio = null;
            updateVoiceStatus('Clique de novo para tocar');
            resolve(false);
          });
        });
      } catch (error) {
        console.warn('Falha ao chamar TTS neural:', error);
        updateVoiceStatus('Erro no TTS neural');
        return false;
      }
    }

    async function ouvirTodas(index = 0) {
      const textos = labels.map(label => label.textContent.trim()).filter(Boolean);
      if (index === 0) {
        stopCurrentAudio();
      }
      for (let i = index; i < textos.length; i++) {
        const tocou = await playTts(textos[i], false);
        if (!tocou) break;
      }
    }



    let ultimaNoticiaFalada = noticiasIniciais[0]?.titulo || "";

    async function atualizarNoticias() {
      try {
        const response = await fetch(window.location.href, { cache: 'no-store' });
        const html = await response.text();
        const match = html.match(/<script>const noticiasIniciais = (.+?);<\/script>/s);
        if (!match) return;

        const novasNoticias = JSON.parse(match[1]);
        if (novasNoticias.length === 0) return;

        const novaNoticia = novasNoticias[0];
        const novoTitulo = novaNoticia.titulo?.trim();

        // ✅ Falar a nova se for diferente da última falada
        if (novoTitulo && novoTitulo !== ultimaNoticiaFalada) {
          falarUltimaNoticia(novoTitulo);
          ultimaNoticiaFalada = novoTitulo;
        }

        // Atualizar visual
        novasNoticias.forEach((n, i) => {
          if (!labels[i]) return;
          const cor = i === 0 ? '#FFD700' : 'white';
          const tempoDecorrido = calcularTempoDecorrido(n.data);
          labels[i].innerHTML = `<a href="${n.link}" target="_blank" style="color:${cor}; text-decoration:none;">${n.titulo} <small>(${tempoDecorrido})</small></a>`;
        });

      } catch (e) {
        console.error("Erro ao atualizar notícias:", e);
      }
    }

    async function falarUltimaNoticia(texto) {
      await playTts("Última notícia: " + texto);
    }

    function calcularTempoDecorrido(timestamp) {
      const agora = Math.floor(Date.now() / 1000);
      const diferenca = agora - timestamp;
      if (diferenca < 60) return 'há poucos segundos';
      if (diferenca < 3600) return `há ${Math.floor(diferenca / 60)} minutos`;
      if (diferenca < 86400) return `há ${Math.floor(diferenca / 3600)} horas`;
      return `há ${Math.floor(diferenca / 86400)} dias`;
    }

    createStars();
    earthImage.onload = animate;
    setInterval(atualizarNoticias, 60000);



    let moonAngle = 0; // ângulo inicial da lua
    const moon = document.querySelector('.moon-button');
    if (moon) {
      moon.addEventListener('click', (e) => {
        e.preventDefault();
        ouvirTodas(0);
      });
    }
    animateMoon();

    function animateMoon() {
      moonAngle += 0.005;

      const metrics = getCanvasMetrics();
      const moonOrbitRadius = metrics.radius + (window.innerWidth <= 480 ? 18 : 42);
      const moonX = metrics.centerX + moonOrbitRadius * Math.cos(moonAngle);
      const moonY = metrics.centerY + moonOrbitRadius * Math.sin(moonAngle);
      const left = clamp(moonX - moon.offsetWidth / 2, 8, window.innerWidth - moon.offsetWidth - 8);
      const top = clamp(moonY - moon.offsetHeight / 2, 8, window.innerHeight - moon.offsetHeight - 8);

      moon.style.left = `${left}px`;
      moon.style.top = `${top}px`;

      requestAnimationFrame(animateMoon);
    }




    // ⚙️ Configurações de satélites personalizáveis
    const sateliteConfigs = [
      { id: 'sat1', velocidade: 0.01, raio: radius + 10, sentido: 1, anguloInicial: 0 },
      { id: 'sat2', velocidade: 0.008, raio: radius + -520, sentido: -1, anguloInicial: Math.PI * 2 / 3 },
      { id: 'sat3', velocidade: 0.002, raio: radius + -150, sentido: 1, anguloInicial: Math.PI * 4 / 3 },
    ];

    const satelites = sateliteConfigs.map(cfg => {
      const sat = {
        el: document.getElementById(cfg.id),
        angle: cfg.anguloInicial,
        speed: cfg.velocidade * cfg.sentido,
        radius: cfg.raio,
        acao: cfg.acao
      };

      sat.el.addEventListener('click', (e) => {
        e.preventDefault();
        if (typeof sat.acao === 'function') {
          sat.acao();
        }
      });

      return sat;
    });

    function animateSatelites() {
      const metrics = getCanvasMetrics();

      satelites.forEach(sat => {
        sat.angle += sat.speed;

        const x = metrics.centerX + sat.radius * metrics.scale * Math.cos(sat.angle);
        const y = metrics.centerY + sat.radius * metrics.scale * Math.sin(sat.angle);
        const left = clamp(x - sat.el.offsetWidth / 2, 4, window.innerWidth - sat.el.offsetWidth - 4);
        const top = clamp(y - sat.el.offsetHeight / 2, 4, window.innerHeight - sat.el.offsetHeight - 4);

        sat.el.style.left = `${left}px`;
        sat.el.style.top = `${top}px`;
      });

      requestAnimationFrame(animateSatelites);
    }

    animateSatelites();




    document.getElementById('sat3').addEventListener('click', (e) => {
      e.preventDefault();
      const texto = noticiasIniciais[0]?.titulo;
      if (texto) {
        falarUltimaNoticia(texto);
      }
    });






  </script>
</body>

</html>
