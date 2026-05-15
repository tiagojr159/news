<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre - Tiago Junior</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-color: #fdfdfd;
      --text-color: #222;
      --accent-color: #2c77ff;
      --section-bg: #ffffff;
      --card-bg: #f1f1f1;
      --transition-speed: 0.3s;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      line-height: 1.6;
    }

    header {
      background-color: var(--accent-color);
      color: white;
      padding: 40px 20px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    nav {
      margin-top: 20px;
    }

    nav a {
      margin: 0 10px;
      text-decoration: none;
      color: white;
      font-weight: bold;
      transition: opacity var(--transition-speed);
    }

    nav a:hover {
      opacity: 0.8;
    }

    section {
      padding: 50px 20px;
      max-width: 1000px;
      margin: auto;
    }

    h2 {
      border-bottom: 2px solid var(--accent-color);
      padding-bottom: 10px;
      margin-bottom: 30px;
      color: var(--accent-color);
    }

    .card {
      background: var(--card-bg);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
      transition: all var(--transition-speed);
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    ul {
      padding-left: 20px;
    }

    .btn {
      background: var(--accent-color);
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }

    .btn:hover {
      background: #1d55cc;
    }

    footer {
      text-align: center;
      padding: 30px 20px;
      background: var(--card-bg);
      margin-top: 50px;
      color: #555;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }
  </style>
</head>

<body>
  <header>
    <h1>Tiago Junior</h1>
    <p>Engenheiro de Sistemas Sênior | Desenvolvedor Full Stack</p>
    <nav>
      <a href="#formacoes">Formações</a>
      <a href="#certificacoes">Certificações</a>
      <a href="#experiencia">Experiência</a>
      <a href="#habilidades">Habilidades</a>
      <a href="#projetos">Projetos</a>
      <a href="#contato">Contato</a>
    </nav>
  </header>

  <section id="formacoes">
    <h2>Formações Acadêmicas</h2>
    <div class="grid">
      <div class="card">
        <h3>Faculdade Santa Emília</h3>
        <p>Bacharelado em Sistemas de Informação (2010–2015)</p>
      </div>
      <div class="card">
        <h3>UniFECAF</h3>
        <p>Pós-graduação em Full Stack Development (2023–2024)</p>
        <ul>
          <li>Web Design</li>
          <li>Front-End & Back-End</li>
          <li>Banco de Dados, Deploy e Cloud</li>
        </ul>
      </div>
      <div class="card">
        <h3>IFPE - Jaboatão</h3>
        <p>Especialização em Desenvolvimento, Inovação e Tecnologias Emergentes</p>
        <ul>
          <li>Big Data, ML, BI</li>
          <li>UI/UX, Gestão Ágil</li>
        </ul>
      </div>
    </div>
  </section>

  <section id="certificacoes">
    <h2>Certificações Técnicas</h2>
    <div class="grid">
      <div class="card">
        <ul>
          <li>Web Design - UniFECAF</li>
          <li>Cloud Computing - UniFECAF</li>
          <li>IoT - UniFECAF</li>
          <li>Scrum Foundation - CertiProf</li>
          <li>Business Intelligence Foundation - CertiProf</li>
          <li>Agile HR Certified - CertiProf</li>
          <li>Hackathon do Bem Recife - Even3</li>
        </ul>
      </div>
    </div>
  </section>

  <section id="experiencia">
    <h2>Experiência Profissional</h2>
    <div class="grid">
      <div class="card">
        <h3>Global Hitss</h3>
        <p>Engenheiro de Sistemas Sênior</p>
        <p>Desenvolvimento de sistemas para o TJMG com PHP, arquitetura MVC e princípios SOLID.</p>
      </div>
      <div class="card">
        <h3>Spassu</h3>
        <p>Desenvolvedor Full Stack</p>
        <p>Sustentação de projetos em PHP e AngularJS para o Tribunal de Justiça.</p>
      </div>
      <div class="card">
        <h3>CWI Software</h3>
        <p>Desenvolvedor Sênior</p>
        <p>Experiência com Laravel e CakePHP, banco Oracle e PostgreSQL.</p>
      </div>
      <div class="card">
        <h3>Indra</h3>
        <p>Desenvolvedor Back-End</p>
        <p>Projetos para o TRF5 em Delphi, Java, PHP e banco MySQL.</p>
      </div>
    </div>
  </section>

  <section id="habilidades">
    <h2>Habilidades Técnicas</h2>
    <div class="card">
      <ul>
        <li><strong>Back-End:</strong> PHP, Java, Node.js, Delphi</li>
        <li><strong>Front-End:</strong> HTML, CSS, JS, ReactJS, Angular</li>
        <li><strong>Bancos:</strong> Oracle, PostgreSQL, MySQL, Firebird</li>
        <li><strong>DevOps:</strong> Git, Docker, CI/CD, GitLab</li>
        <li><strong>Boas práticas:</strong> SOLID, MVC, Refatoração</li>
        <li><strong>Outros:</strong> REST APIs, JSON, XML, SCRUM, Jira</li>
      </ul>
      <button class="btn">📄 Baixar Currículo PDF</button>
    </div>
  </section>

  <section id="projetos">
    <h2>Projetos de Destaque</h2>
    <div class="grid">
      <div class="card">
        <h3>Sistema de Gestão Judiciária</h3>
        <p>Desenvolvido para o TJMG com foco em performance e integração com APIs.</p>
      </div>
      <div class="card">
        <h3>Portal de Estágios TJRS</h3>
        <p>Laravel, autenticação, CRUD e relatórios PDF automáticos.</p>
      </div>
      <div class="card">
        <h3>Sistema de Rastreio</h3>
        <p>Dashboard com Node.js e atualizações em tempo real via WebSocket.</p>
      </div>
    </div>
  </section>

  <section id="contato">
    <h2>Contato</h2>
    <div class="card">
      <p><strong>Email:</strong> tiago.severino@example.com</p>
      <p><strong>LinkedIn:</strong> linkedin.com/in/tiagojunior</p>
      <p><strong>GitHub:</strong> github.com/tiagojunior</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Tiago Junior. Todos os direitos reservados.</p>
  </footer>
</body>

</html>