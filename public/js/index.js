document.addEventListener("DOMContentLoaded", function () {
    const lang = document.getElementById("lang");
    const overlays = document.getElementById("overlays");
    let overlayTimeout;

    function createOverlayContent() {
        const container = document.createElement("div");
        container.className = "language-selector-container";

        const list = document.createElement("ul");
        list.className = "language-list";

        const languages = [
            { code: "fr", name: "Français" },
            { code: "es", name: "Español" },
            { code: "en", name: "English" },
        ];

        languages.forEach((lang) => {
            const listItem = document.createElement("li");
            listItem.className = "language-item";

            const link = document.createElement("a");
            link.className = "language-link";
            link.href = `${window.location.pathname}change-language/${lang.code}`;
            link.tabIndex = 0;

            link.append(lang.name);
            listItem.appendChild(link);
            list.appendChild(listItem);
        });

        container.appendChild(list);
        return container;
    }

    function addOverlay() {
        clearTimeout(overlayTimeout);
        if (
            !overlays.contains(
                document.querySelector(".language-selector-container")
            )
        ) {
            const overlayContent = createOverlayContent();
            overlays.innerHTML = "";

            // Appliquer le style de transformation initiale pour le mouvement

            const rect = lang.getBoundingClientRect();
            const langPosition = { x: rect.left, y: rect.bottom + 5 };
            // recupérer la position de la div lang
            overlayContent.style.transform = `translate(${langPosition.x}px, ${langPosition.y}px)`;

            overlays.appendChild(overlayContent);
        }
    }

    function attemptRemoveOverlay() {
        overlayTimeout = setTimeout(() => {
            overlays.innerHTML = "";
        }, 200);
    }

    lang.addEventListener("mouseenter", addOverlay);
    lang.addEventListener("mouseleave", attemptRemoveOverlay);
    overlays.addEventListener("mouseenter", addOverlay);
    overlays.addEventListener("mouseleave", attemptRemoveOverlay);
});
