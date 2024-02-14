document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        fetch(`search.php?search=${searchTerm}`)
            .then(response => response.json())
            .then(data => {
                updateAnimeList(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    });

    function updateAnimeList(data) {
        const animeList = document.getElementById('animeList');
        animeList.innerHTML = ''; // Clear the anime list before updating with new results

        data.forEach(anime => {
            const card = document.createElement('div');
            card.classList.add('col-md-6', 'mb-3');
            card.innerHTML = `
                <div class="card position-relative">
                    <a href="eps/episode.php?id=${anime.judul}">
                        <img src="${anime.gambar}" class="card-img-top" alt="${anime.judul}">
                        
                        <div class="overlay">
                          <div class="card-title-hover">${anime.judul}
                          </div>
                        </div>
                    </a>
                </div>
            `;
            animeList.appendChild(card);
        });
    }
});
