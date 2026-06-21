/* php-extractor-correos - script.js */
(function(){
  'use strict';

  // Copiar lista completa
  const btnCopiar = document.getElementById('btn-copiar');
  if (btnCopiar) {
    btnCopiar.addEventListener('click', async () => {
      const codigos = document.querySelectorAll('.correo-fila code');
      const lista = Array.from(codigos).map(c => c.textContent).join('\n');
      try {
        await navigator.clipboard.writeText(lista);
        const o = btnCopiar.textContent;
        btnCopiar.textContent = '✅ Copiado!';
        setTimeout(() => btnCopiar.textContent = o, 1500);
      } catch(e) { alert('No se pudo copiar'); }
    });
  }

  // Copiar CSV
  const btnCsv = document.getElementById('btn-csv');
  if (btnCsv) {
    btnCsv.addEventListener('click', async () => {
      const codigos = document.querySelectorAll('.correo-fila code');
      const csv = Array.from(codigos).map(c => c.textContent).join(', ');
      try {
        await navigator.clipboard.writeText(csv);
        const o = btnCsv.textContent;
        btnCsv.textContent = '✅ Copiado!';
        setTimeout(() => btnCsv.textContent = o, 1500);
      } catch(e) { alert('No se pudo copiar'); }
    });
  }

  // Copiar email individual
  document.querySelectorAll('.btn-mini').forEach(btn => {
    btn.addEventListener('click', async () => {
      const email = btn.dataset.email;
      if (!email) return;
      try {
        await navigator.clipboard.writeText(email);
        btn.textContent = '✅';
        setTimeout(() => btn.textContent = '📋', 1200);
      } catch(e) { alert('No se pudo copiar'); }
    });
  });
})();