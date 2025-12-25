const form = document.getElementById('criminalRecordForm');
const msg = document.getElementById('message');
const btn = document.getElementById('submitBtn');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    btn.disabled = true;
    btn.textContent = 'Wysyłanie...';

    const data = Object.fromEntries(new FormData(form));

    try {
        const res = await fetch('../backend/send.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (result.success) {
            msg.className = 'success';
            msg.innerText = '✅ Wniosek wysłany!';
            form.reset();
        } else {
            msg.className = 'error';
            msg.innerText = '❌ Wystąpił błąd: ' + (result.error || 'Nieznany');
        }

    } catch (err) {
        msg.className = 'error';
        msg.innerText = '❌ Błąd sieci.';
    } finally {
        btn.disabled = false;
        btn.textContent = 'Wyślij wniosek';
        msg.style.display = 'block';
    }
});
