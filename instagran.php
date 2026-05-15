<?php
// 🔧 CONFIGURAÇÕES – Substitua pelas suas chaves e IDs:
$BING_KEY   = 'SUA_BING_KEY_AQUI';
$GOOGLE_KEY = 'SUA_GOOGLE_API_KEY_AQUI';
$GOOGLE_CX  = 'SEU_GOOGLE_CSE_ID_AQUI';
$IG_ACCESS  = '972aca4d14cc300d6af33ecef44a4264';
$IG_USER_ID = 'SEU_INSTAGRAM_USER_ID';

// Função: buscar notícias no Bing News API
function buscarBing($q) {
    global $BING_KEY;
    $url = 'https://api.bing.microsoft.com/v7.0/news/search?q=' . urlencode($q) . '&count=5&mkt=pt-BR';
    $opts = ['http' => ['header' => "Ocp-Apim-Subscription-Key: $BING_KEY\r\n"]];
    $json = @file_get_contents($url, false, stream_context_create($opts));
    return $json ? json_decode($json, true)['value'] ?? [] : [];
}

// Função: buscar via Google Custom Search
function buscarGoogle($q) {
    global $GOOGLE_KEY, $GOOGLE_CX;
    $url = "https://www.googleapis.com/customsearch/v1?key=$GOOGLE_KEY&cx=$GOOGLE_CX&q=" . urlencode($q) . "&num=5";
    $json = @file_get_contents($url);
    return $json ? json_decode($json, true)['items'] ?? [] : [];
}

// Função: buscar posts na sua conta do Instagram via Graph API
function buscarInsta() {
    global $IG_ACCESS, $IG_USER_ID;
    $url = "https://graph.facebook.com/v18.0/$IG_USER_ID/media?fields=id,caption,permalink,media_url,timestamp&access_token=$IG_ACCESS";
    $json = @file_get_contents($url);
    return $json ? json_decode($json, true)['data'] ?? [] : [];
}

// Se for chamada AJAX, retorna JSON com os três resultados
if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    header('Content-Type: application/json');
    $bing   = buscarBing('Igarassu');
    $google = buscarGoogle('Igarassu instagram twitter facebook');
    $insta  = buscarInsta();
    echo json_encode(compact('bing', 'google', 'insta'), JSON_UNESCAPED_UNICODE);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Consulta Igarassu nas redes</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f7f7f7; }
    h1,h2 { color: #2c3e50; }
    section { background: #fff; padding: 15px; margin-bottom: 20px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    a { color: #1565c0; text-decoration: none; }
    .insta-img { max-width: 150px; display: block; margin-bottom: 5px; }
  </style>
</head>
<body>
  <h1>🔍 Consulta “Igarassu” nas principais fontes</h1>
  <div id="conteudo">Carregando resultados...</div>

  <script>
    fetch('?ajax=1')
      .then(res => res.json())
      .then(data => {
        const c = document.getElementById('conteudo');
        let html = '';

        html += '<section><h2>Bing News</h2>';
        if (data.bing.length) {
          data.bing.forEach(n => {
            const date = new Date(n.datePublished).toLocaleString();
            html += `<p><a href="${n.url}" target="_blank">${n.name}</a><br><em>${n.provider[0].name} • ${date}</em></p>`;
          });
        } else html += '<p>Sem notícias via Bing.</p>';
        html += '</section>';

        html += '<section><h2>Resultados Google (Instagram/Twitter/Facebook)</h2>';
        if (data.google.length) {
          data.google.forEach(r => {
            html += `<p><a href="${r.link}" target="_blank">${r.title}</a><br>${r.snippet}</p>`;
          });
        } else html += '<p>Sem resultados via Google.</p>';
        html += '</section>';

        html += '<section><h2>Instagram (sua conta)</h2>';
        if (data.insta.length) {
          data.insta.forEach(p => {
            const date = new Date(p.timestamp).toLocaleString();
            html += `<p><a href="${p.permalink}" target="_blank">
                      <img class="insta-img" src="${p.media_url}">
                      ${p.caption ? p.caption : 'Ver postagem'}
                      <br><em>${date}</em>
                    </a></p>`;
          });
        } else html += '<p>Sem posts publicados.</p>';
        html += '</section>';

        c.innerHTML = html;
      })
      .catch(err => document.getElementById('conteudo').innerText = 'Erro: ' + err);
  </script>
</body>
</html>
