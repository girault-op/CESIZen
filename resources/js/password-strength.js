document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const bar = document.getElementById('cz-strength-bar');
    const text = document.getElementById('cz-strength-text');
  
    if (!passwordInput || !bar || !text) return; // Sécurité si un ID manque
  
    passwordInput.addEventListener('input', function() {
      const val = passwordInput.value;
      let score = 0;
      if (val.length >= 8) score++;
      if (/[A-Z]/.test(val)) score++;
      if (/[a-z]/.test(val)) score++;
      if (/[0-9]/.test(val)) score++;
      if (/[^A-Za-z0-9]/.test(val)) score++;
  
      if (score <= 2) {
        bar.style.width = "33%";
        bar.style.background = "#e74c3c";
        text.textContent = "Très faible";
        text.className = "cz-strength-text";
      } else if (score === 3 || score === 4) {
        bar.style.width = "66%";
        bar.style.background = "#f39c12";
        text.textContent = "Moyen";
        text.className = "cz-strength-text medium";
      } else if (score === 5) {
        bar.style.width = "100%";
        bar.style.background = "#27ae60";
        text.textContent = "Fort";
        text.className = "cz-strength-text strong";
      }
    });
  });
  