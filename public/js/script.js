document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menu-btn');
            const menu = document.getElementById('menu');

            menuBtn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
            
            
            // Hide menu when a link is clicked
            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                });
            });

            const filterButtons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.card');

            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const filter = btn.getAttribute('data-filter');
                    filterButtons.forEach(b => {
                        b.classList.remove('bg-orange-500');
                        b.classList.add('bg-gray-700');
                    });
                    btn.classList.remove('bg-gray-700');
                    btn.classList.add('bg-orange-500');

                    cards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-genre') === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });