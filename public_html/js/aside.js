function updateWorldClocks() {
    const now = new Date();

    // Horário de Brasília (UTC-3)
    const brasiliaTime = new Date(now.toLocaleString("en-US", { timeZone: "America/Sao_Paulo" }));
    document.getElementById("time-brasilia").textContent = brasiliaTime.toLocaleTimeString();

    // Horário de Nova York (UTC-4 ou UTC-5 dependendo do horário de verão)
    const newYorkTime = new Date(now.toLocaleString("en-US", { timeZone: "America/New_York" }));
    document.getElementById("time-new-york").textContent = newYorkTime.toLocaleTimeString();

    // Horário de Londres (UTC+0 ou UTC+1 dependendo do horário de verão)
    const londonTime = new Date(now.toLocaleString("en-US", { timeZone: "Europe/London" }));
    document.getElementById("time-london").textContent = londonTime.toLocaleTimeString();

    // Horário de Tóquio (UTC+9)
    const tokyoTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Tokyo" }));
    document.getElementById("time-tokyo").textContent = tokyoTime.toLocaleTimeString();
}

setInterval(updateWorldClocks, 1000);
