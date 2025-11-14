<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Réserver ma place — Formulaire</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root{
      --bg:#0b0b0d;
      --card-top:#0f2b5a;
      --card-bottom:#0b1f45;
      --input-bg:#050506;
      --accent:#d97706;
      --text:#F5F7FA;
    }
    html,body{height:100%}
    body{
      font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: radial-gradient(1200px 400px at 50% 5%, rgba(15,43,90,0.12), transparent 12%), var(--bg);
      color:var(--text);
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }

    /* Modal animation */
    .modal-enter { transform: translateY(8px) scale(.99); opacity: 0 }
    .modal-enter-active { transform: translateY(0) scale(1); opacity: 1; transition: all 220ms cubic-bezier(.2,.9,.2,1) }
    .modal-leave { transform: translateY(0) scale(1); opacity: 1 }
    .modal-leave-active { transform: translateY(8px) scale(.99); opacity: 0; transition: all 160ms cubic-bezier(.2,.9,.2,1) }
  </style>
</head>
<body class="min-h-screen flex flex-col">
      <a href="{{ url('/direct') }}" class="mb-44 p-8 w-70">
        <i></i> Retour aux activités
      </a>
  <!-- Container -->
  <main class="flex-1 flex items-center justify-center p-6">
    <div class="w-full max-w-[420px] mx-auto">
      <!-- Card -->
      <section
        class="relative rounded-2xl overflow-hidden shadow-2xl"
        style="background: linear-gradient(180deg, var(--card-top), var(--card-bottom)); border: 1px solid rgba(255, 255, 255, 0.47);"
      >
        <div class="p-6 sm:p-8">
          <h1 class="text-center text-lg font-semibold">RESERVER MA PLACE</h1>
          <p class="text-center text-[13px] text-slate-200/70 mt-2 mb-5">
            Remplis ce formulaire pour réserver ta place à cette activité solidaire
          </p>

          <!-- Form -->
          <form id="bookingForm" novalidate class="space-y-4" aria-describedby="consentText">
            <!-- Prénom -->
            <div>
              <label for="prenom" class="block text-sm text-slate-200/80 mb-1">Prénom <span class="text-orange-400">*</span></label>
              <input id="prenom" name="prenom" required aria-required="true"
                     value="Jean"
                     class="w-full rounded-lg py-3 px-4 bg-[var(--input-bg)] text-white placeholder:text-slate-400 border border-transparent focus:outline-none focus:ring-2 focus:ring-sky-400"
                     placeholder="Jean" />
              <p class="mt-1 text-xs text-rose-300 hidden" id="err-prenom">Veuillez entrer un prénom.</p>
            </div>

            <!-- Nom -->
            <div>
              <label for="nom" class="block text-sm text-slate-200/80 mb-1">Nom <span class="text-orange-400">*</span></label>
              <input id="nom" name="nom" required aria-required="true"
                     value="Dupont"
                     class="w-full rounded-lg py-3 px-4 bg-[var(--input-bg)] text-white placeholder:text-slate-400 border border-transparent focus:outline-none focus:ring-2 focus:ring-sky-400"
                     placeholder="Dupont" />
              <p class="mt-1 text-xs text-rose-300 hidden" id="err-nom">Veuillez entrer un nom.</p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm text-slate-200/80 mb-1">Email <span class="text-orange-400">*</span></label>
              <input id="email" name="email" type="email" required aria-required="true"
                     value="jeandupont@gmail.com"
                     class="w-full rounded-lg py-3 px-4 bg-[var(--input-bg)] text-white placeholder:text-slate-400 border border-transparent focus:outline-none focus:ring-2 focus:ring-sky-400"
                     placeholder="jeandupont@gmail.com" />
              <p class="mt-1 text-xs text-rose-300 hidden" id="err-email">Adresse e-mail non valide.</p>
            </div>

            <!-- Téléphone -->
            <div>
              <label for="phone" class="block text-sm text-slate-200/80 mb-1">Téléphone <span class="text-orange-400">*</span></label>
              <input id="phone" name="phone" type="tel" required aria-required="true"
                     value="+229 01 23 45 67 89"
                     pattern="^\+229\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}$"
                     class="w-full rounded-lg py-3 px-4 bg-[var(--input-bg)] text-white placeholder:text-slate-400 border border-transparent focus:outline-none focus:ring-2 focus:ring-sky-400"
                     placeholder="+229 01 23 45 67 89" />
              <p class="mt-1 text-xs text-rose-300 hidden" id="err-phone">Format requis : +229 XX XX XX XX</p>
            </div>

            <!-- Button -->
            <div class="pt-2">
              <button id="submitBtn" type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-full py-3 px-4 font-semibold text-white" style="background:var(--accent); box-shadow:0 6px 18px rgba(217,119,6,0.18)">
                Confirmer ma réservation
              </button>
            </div>

            <p id="consentText" class="text-center text-[12px] text-slate-200/60 mt-3">
              En réservant, tu acceptes de participer activement à cette activité solidaire.
            </p>
          </form>
        </div>
      </section>
    </div>
  </main>

  <!-- Modal (success popup) -->
  <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div id="modalCard" class="w-[92%] max-w-md rounded-xl p-6 bg-white text-slate-900 shadow-xl transform transition" role="document">
      <div class="flex items-start gap-4">
        <div class="flex-shrink-0">
          <!-- Success icon -->
          <svg class="w-10 h-10 text-green-600" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="rgba(34,197,94,0.08)"/><path d="M7 12.5l2.6 2.6L17 8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="flex-1">
          <h2 id="modalTitle" class="text-lg font-semibold">Réservation confirmée</h2>
          <p id="modalMessage" class="mt-2 text-sm text-slate-700 leading-snug">Merci — ta réservation a bien été prise en compte.</p>
        </div>
      </div>

      <div class="mt-5 flex items-center justify-end gap-3">
        <button id="modalClose" class="px-4 py-2 rounded-md border border-slate-200 text-sm">Fermer</button>
      </div>
    </div>
  </div>

  <footer class="bg-black py-12 px-6 border-t border-gray-800 mt-20">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 mb-2">Cotonou, Bénin</p>
                <p class="text-gray-300 mb-2">+229 XX XX XX</p>
                <p class="text-gray-400 text-sm">© 2025. Tous droits réservés</p>
            </div>
        </div>
    </footer>

  <!-- Script: validation + modal handling -->
  <script>
    (function(){
      const form = document.getElementById('bookingForm');
      const modalOverlay = document.getElementById('modalOverlay');
      const modalMessage = document.getElementById('modalMessage');
      const closeBtn = document.getElementById('modalClose');

      // error elements
      const errPrenom = document.getElementById('err-prenom');
      const errNom = document.getElementById('err-nom');
      const errEmail = document.getElementById('err-email');
      const errPhone = document.getElementById('err-phone');

      // helper to show/hide errors
      function showError(el, show){
        if(!el) return;
        el.style.display = show ? 'block' : 'none';
      }

      // Format phone for display (simple normalize)
      function normalizePhone(phone){
        return phone.trim().replace(/\s+/g,' ').replace(/[^+\d ]/g,'');
      }

      // Validate phone pattern (matches pattern attribute)
      function validPhone(value){
        const p = /^\+229\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}$/;
        return p.test(value);
      }

      function openModal(message){
        modalMessage.textContent = message;
        modalOverlay.classList.remove('hidden');
        modalOverlay.setAttribute('aria-hidden','false');

        // add enter animation classes
        const card = document.getElementById('modalCard');
        card.classList.add('modal-enter');
        requestAnimationFrame(()=> {
          card.classList.add('modal-enter-active');
          card.classList.remove('modal-enter');
        });

        // autofocus the close button for keyboard users
        closeBtn.focus();
      }

      function closeModal(){
        const card = document.getElementById('modalCard');
        // leave animation
        card.classList.add('modal-leave-active');
        setTimeout(()=>{
          modalOverlay.classList.add('hidden');
          modalOverlay.setAttribute('aria-hidden','true');
          card.classList.remove('modal-leave-active');
        }, 160);
      }

      // close on overlay click (but not when clicking the card)
      modalOverlay.addEventListener('click', (e) => {
        if(e.target === modalOverlay) closeModal();
      });

      closeBtn.addEventListener('click', closeModal);

      // keyboard: Esc to close modal
      document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape' && !modalOverlay.classList.contains('hidden')) {
          closeModal();
        }
      });

      form.addEventListener('submit', function(evt){
        evt.preventDefault();

        // grab values
        const prenom = form.prenom.value.trim();
        const nom = form.nom.value.trim();
        const email = form.email.value.trim();
        const phone = normalizePhone(form.phone.value);

        // basic validation
        let ok = true;

        if(!prenom){
          ok = false; showError(errPrenom, true);
        } else showError(errPrenom, false);

        if(!nom){
          ok = false; showError(errNom, true);
        } else showError(errNom, false);

        if(!email || !/^\S+@\S+\.\S+$/.test(email)){
          ok = false; showError(errEmail, true);
        } else showError(errEmail, false);

        if(!validPhone(phone)){
          ok = false; showError(errPhone, true);
        } else showError(errPhone, false);

        // If invalid, focus first invalid
        if(!ok){
          const firstError = document.querySelector('p.text-rose-300:not([style*="display: none"])');
          if(firstError){
            const related = firstError.id.replace('err-','');
            const input = document.getElementById(related);
            if(input) input.focus();
          }
          return;
        }

        // If ok -> show modal with summary
        const maskedPhone = phone.replace(/(\+229)\s?(\d{2})\s?(\d{2})\s?(\d{2})\s?(\d{2})/, '$1 $2 $2 $3 $4'); // simple mask demonstration
        const message = `Merci ${prenom} ${nom} — nous avons bien reçu ta réservation.\nEmail : ${email}\nTéléphone : ${phone}`;
        openModal(message);

        // Optionally reset form after success (comment/uncomment)
        // form.reset();
      });
    })();
  </script>
</body>
</html>