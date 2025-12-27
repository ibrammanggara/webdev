<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const main = document.getElementById('mainContent');

        if (!sidebar || !overlay || !main) {
            console.error('Sidebar / Overlay / MainContent not found');
            return;
        }

        const isHidden = sidebar.classList.contains('-translate-x-72');

        if (isHidden) {
            // BUKA SIDEBAR
            sidebar.classList.remove('-translate-x-72');
            sidebar.classList.add('translate-x-0');

            main.classList.add('lg:ml-72');

            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            // TUTUP SIDEBAR
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-72');

            main.classList.remove('lg:ml-72');

            overlay.classList.remove('opacity-100', 'pointer-events-auto');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        }
    }
</script>
