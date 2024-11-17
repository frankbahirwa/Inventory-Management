<form action="#" method="post">
    <input 
        style="width:12.4cm;margin-top:-20px;" 
        type="text" 
        name="input-search" 
        class="search" 
        id="search" 
        placeholder="Search Products..." 
        list="suggestions">
    <button style="width:2cm;background:black;position:absolute;margin-top:-20px;" name="search">Search</button>
    <datalist style="background:red;padding:5px;position:absolute;top:8cm;left:8;" id="suggestions"></datalist>
</form>

<script>
    const searchInput = document.getElementById('search');
    const suggestionsList = document.getElementById('suggestions');

    searchInput.addEventListener('input', () => {
        const term = searchInput.value;
        if (term.length > 1) {
            fetch(`get_suggestions.php?term=${encodeURIComponent(term)}`)
                .then(response => response.json())
                .then(data => {
                    // Clear previous suggestions
                    suggestionsList.innerHTML = '';
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item;
                        suggestionsList.appendChild(option);
                    });
                });
        }
    });