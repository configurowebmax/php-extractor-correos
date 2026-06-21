<?php
/**
 * Extractor de Correos Electrónicos
 * Extrae todos los emails válidos de un texto usando regex.
 */
header('Content-Type: text/html; charset=utf-8');

$correos = [];
$total = 0;
$textoIn = '';
$unicos = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['texto'])) {
    $textoIn = $_POST['texto'];
    $unicos = isset($_POST['unicos']);
    // Regex robusta para emails
    preg_match_all('/[a-z0-9_\.\-\+]+@[a-z0-9\-]+\.[a-z]{2,}(?:\.[a-z]{2,})?/i', $textoIn, $matches);
    $correos = $matches[0];
    if ($unicos) $correos = array_values(array_unique($correos));
    $total = count($correos);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Extractor de Correos Electrónicos Online Gratis | ConfiguroWeb</title>
<meta name="description" content="Extrae todos los emails válidos de cualquier texto. Filtra duplicados y copia la lista. Herramienta gratis de ConfiguroWeb.">
<meta name="keywords" content="extractor correos, extraer emails, email extractor, regex email, scrapear emails">
<meta property="og:type" content="website">
<meta property="og:title" content="Extractor de Correos Electrónicos Online Gratis">
<meta property="og:description" content="Extrae todos los emails válidos de cualquier texto al instante.">
<link rel="canonical" href="https://demoscweb.com/github/php-extractor-correos/">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebApplication","name":"Extractor de Correos","applicationCategory":"DeveloperApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"author":{"@type":"Person","name":"ConfiguroWeb","url":"https://configuroweb.com"}}
</script>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
  <h1>📧 Extractor de Correos Electrónicos</h1>
  <p class="subtitle">Extrae todos los emails válidos de cualquier texto.</p>
</header>
<main>
  <form method="POST">
    <label for="texto">Pega aquí el texto a analizar:</label>
    <textarea name="texto" id="texto" rows="10" placeholder="Contacto: juan@email.com, ventas@empresa.co..."><?php echo htmlspecialchars($textoIn); ?></textarea>

    <div class="opciones">
      <label class="check">
        <input type="checkbox" name="unicos" value="1" <?php echo $unicos ? 'checked' : ''; ?>>
        Eliminar duplicados
      </label>
    </div>

    <button type="submit" class="btn-primary">📧 Extraer correos</button>
  </form>

  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
  <div class="resultados">
    <h2><?php echo $total; ?> correo(s) encontrado(s)</h2>

    <?php if ($total > 0): ?>
    <div class="botones">
      <button type="button" class="btn-secundario" id="btn-copiar" data-copy="lista-correos">📋 Copiar lista</button>
      <button type="button" class="btn-secundario" id="btn-csv">📊 Copiar CSV</button>
    </div>

    <div class="lista-correos" id="lista-correos">
      <?php foreach ($correos as $i => $email): ?>
      <div class="correo-fila">
        <span class="num"><?php echo $i+1; ?>.</span>
        <code><?php echo htmlspecialchars($email); ?></code>
        <button class="btn-mini" data-email="<?php echo htmlspecialchars($email); ?>">📋</button>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="vacio">No se encontraron correos válidos en el texto.</p>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <section class="info">
    <h2>¿Cómo funciona?</h2>
    <p>Esta herramienta usa una <strong>expresión regular (regex)</strong> para identificar patrones de email válidos dentro de cualquier texto. Útil para:</p>
    <ul>
      <li>Extraer contactos de textos largos.</li>
      <li>Limpiar listas de correos con ruido.</li>
      <li>Depurar contenido copiado de webs.</li>
    </ul>
    <p class="aviso">⚠️ Uso ético: Respeta el RGPD y leyes de protección de datos. No uses esta herramienta para spam.</p>
  </section>
</main>
<footer>
  <p>Desarrollado por <a href="https://configuroweb.com" target="_blank">ConfiguroWeb</a> ·
     <a href="https://appscweb.com/citas/" target="_blank">Sistema de Citas</a> ·
     <a href="https://appscweb.com/negocios/" target="_blank">Gestión de Negocios</a></p>
  <p>&copy; <?php echo date('Y'); ?> ConfiguroWeb</p>
</footer>
<script src="assets/script.js"></script>
</body>
</html>