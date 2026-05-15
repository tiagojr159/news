<?php
// Lista de feeds exceto UOL (que será tratado à parte)
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

// Desabilita verificação de certificado SSL
libxml_set_streams_context(stream_context_create([
  'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
]));

// Remove o nome do dia da semana para strtotime funcionar corretamente
function converteDataUOL($data)
{
  return preg_replace('/^[A-Za-zÀ-ÿ]{3},\s*/', '', $data);
}

function minutos_ago($data)
{
  $timestamp = strtotime($data);
  if (!$timestamp)
    return "tempo indefinido";
  $dif = time() - $timestamp;
  $min = floor($dif / 60);
  return $min < 1 ? "agora mesmo" : "$min min atrás";
}

// Função dedicada para tratar o feed da UOL
function carregarUOLFeed($url)
{
  $noticias = [];
  $rss = simplexml_load_file($url);
  if (!$rss || !isset($rss->channel->item))
    return $noticias;

  foreach ($rss->channel->item as $item) {
    $titulo = trim((string) $item->title);
    $link = trim((string) $item->link);
    $data = trim((string) $item->pubDate);
    $dataConvertida = converteDataUOL($data);
    $timestamp = strtotime($dataConvertida);
    if (!$timestamp || (time() - $timestamp) > 864000)
      continue;


    $noticias[] = [
      'titulo' => $titulo,
      'link' => $link,
      'fonte' => 'UOL',
      'minutos' => minutos_ago($dataConvertida),
      'timestamp' => $timestamp
    ];
  }

  return $noticias;
}

$noticias = [];
$noticias = array_merge($noticias, carregarUOLFeed('https://rss.uol.com.br/feed/noticias.xml'));

// Carrega os demais feeds
foreach ($feeds as $fonte => $url) {
  try {
    $rss = @simplexml_load_file($url);
    if (!$rss || !isset($rss->channel->item))
      continue;

    foreach ($rss->channel->item as $item) {
      $titulo = (string) $item->title;
      $link = (string) $item->link;
      $data = (string) $item->pubDate;
      $timestamp = strtotime($data);
      if (!$timestamp || (time() - $timestamp) > 864000)
        continue;

      $noticias[] = [
        'titulo' => $titulo,
        'link' => $link,
        'fonte' => $fonte,
        'minutos' => minutos_ago($data),
        'timestamp' => $timestamp
      ];
    }
  } catch (Exception $e) {
    continue;
  }
}

// Ordena por mais recente
usort($noticias, fn($a, $b) => $b['timestamp'] - $a['timestamp']);
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Feed de Notícias</title>
  <style>
    body {
      font-family: Arial;
      background: #f2f2f2;
      padding: 20px;
      margin: 0;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .manchete-destaque {
      background: #007BFF;
      color: #fff;
      padding: 120px;
      font-size: 4.2em;
      font-weight: bold;
      text-align: center;
      min-height: 80px;
    }

    .manchete-destaque a {
      color: #fff;
      text-decoration: none;
    }

    .ouvir-btn {
      display: block;
      margin: 10px auto 20px auto;
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 1.5em;
      border-radius: 5px;
      cursor: pointer;
    }

    .noticia {
      background: #fff;
      padding: 15px;
      margin-bottom: 10px;
      border-left: 5px solid #007BFF;
      font-size: 1.5em;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      position: relative;
    }

    .fonte {
      font-size: 1.3em;
      color: #666;
    }

    .tempo {
      font-size: 1.2em;
      color: #999;
    }

    .ouvir-individual {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #17a2b8;
      color: white;
      border: none;
      padding: 6px 10px;
      font-size: 1.0em;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="manchete-destaque" id="mancheteDestaque">Carregando manchetes...</div>

  <button class="ouvir-btn" onclick="ouvirTodas()">🔊 Ouvir Manchetes</button>

  <h2>📰 Últimas Notícias</h2>

  <div id="listaNoticias">
    <?php foreach ($noticias as $i => $n): ?>
      <div class="noticia">
        <button class="ouvir-individual" onclick="ouvirTexto(`<?= htmlspecialchars($n['titulo'], ENT_QUOTES) ?>`)">🔊
          Ouvir</button>
        <a href="<?= htmlspecialchars($n['link']) ?>" target="_blank">
          <strong><?= htmlspecialchars($n['titulo']) ?></strong>
        </a><br>
        <span class="fonte"><?= htmlspecialchars($n['fonte']) ?></span> •
        <span class="tempo"><?= htmlspecialchars($n['minutos']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (empty($noticias)): ?>
    <p>❌ Nenhuma notícia foi carregada.</p>
  <?php endif; ?>

  <script>
    const manchetes = <?= json_encode(array_slice($noticias, 0, 10)) ?>;
    let mancheteIndex = 0;
    let ultimaManchete = manchetes[0]?.titulo || "";

    function atualizarManchete() {
      const manchete = manchetes[mancheteIndex];
      const container = document.getElementById("mancheteDestaque");

      if (manchete) {
        ultimaManchete = manchete.titulo;
        container.innerHTML = `<a href="${manchete.link}" target="_blank">${manchete.titulo}</a>`;
      }

      mancheteIndex = (mancheteIndex + 1) % manchetes.length;
    }

    // Inicia carrossel de manchetes
    atualizarManchete();
    setInterval(atualizarManchete, 4000);

    function detectarIdioma(texto) {
      // Heurística simples: se mais de 30% das palavras forem comuns em inglês, consideramos inglês
      const palavrasIngles = ['the', 'and', 'of', 'to', 'in', 'for', 'on', 'with', 'as', 'at', 'by'];
      const palavras = texto.toLowerCase().split(/\s+/);
      const comuns = palavras.filter(p => palavrasIngles.includes(p)).length;
      return comuns / palavras.length > 0.3 ? 'en' : 'pt';
    }

    async function traduzirTexto(texto, de = 'en', para = 'pt') {
      const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(texto)}&langpair=${de}|${para}`;
      try {
        const res = await fetch(url);
        const json = await res.json();
        return json.responseData.translatedText || texto;
      } catch {
        return texto; // Em caso de erro, retorna o texto original
      }
    }

    async function ouvirTexto(texto) {
  if (!texto || !('speechSynthesis' in window)) return;

  window.speechSynthesis.cancel();

  const idiomaDetectado = detectarIdioma(texto);
  let textoFinal = texto;

  if (idiomaDetectado === 'en') {
    textoFinal = await traduzirTexto(texto);
  }

  const msg = new SpeechSynthesisUtterance(textoFinal);
  msg.lang = 'pt-BR';
  msg.rate = 1.5;
  window.speechSynthesis.speak(msg);
}

    function ouvirTodas(index = 0) {
      if (!('speechSynthesis' in window) || !manchetes.length) return;

      if (index >= manchetes.length) return;

      window.speechSynthesis.cancel();

      const msg = new SpeechSynthesisUtterance(manchetes[index].titulo);
      msg.lang = 'pt-BR';
      msg.rate = 1.5; // Velocidade aumentada
      msg.onend = function () {
        ouvirTodas(index + 1);
      };

      window.speechSynthesis.speak(msg);
    }
  </script>
</body>

</html>

