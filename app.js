const form = document.getElementById("form");
const msg = document.getElementById("msg");

form.addEventListener("submit", async e => {
    e.preventDefault();

    const data = Object.fromEntries(new FormData(form));

    const res = await fetch("/backend/send.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    msg.innerText = res.ok
        ? "✅ Wniosek wysłany"
        : "❌ Błąd wysyłania";
});
