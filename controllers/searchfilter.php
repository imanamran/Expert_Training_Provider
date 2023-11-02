<script>
	// Get all program cards
	const cards = document.querySelectorAll('.card');

	// Get filter form elements
	const locationFilter = document.getElementById('location');
	const durationFilter = document.getElementById('duration');
	const priceFilter = document.getElementById('price');

	// Get search form elements
	const searchInput = document.querySelector('.search input');
	const searchButton = document.querySelector('.search button');

	// Add event listeners for filter form
	locationFilter.addEventListener('change', filterPrograms);
	durationFilter.addEventListener('change', filterPrograms);
	priceFilter.addEventListener('change', filterPrograms);

	// Add event listeners for search form
	searchInput.addEventListener('input', searchPrograms);
	searchButton.addEventListener('click', searchPrograms);

	// Function to filter programs based on filter form values
	function filterPrograms() {
		const locationValue = locationFilter.value;
		const durationValue = durationFilter.value;
		const priceValue = priceFilter.value;

		cards.forEach(card => {
			const location = card.querySelector('p:nth-of-type(2)').textContent.split(': ')[1];
			const duration = card.querySelector('p:nth-of-type(3)').textContent.split(': ')[1];
			const price = card.querySelector('p:nth-of-type(4)').textContent.split(': ')[1];

			if ((locationValue === '' || location === locationValue) &&
				(durationValue === '' || duration === durationValue) &&
				(priceValue === '' || price === priceValue)) {
				card.style.display = 'block';
			} else {
				card.style.display = 'none';
			}
		});
	}

	// Function to search programs based on search form value
	function searchPrograms() {
		const searchValue = searchInput.value.toLowerCase();

		cards.forEach(card => {
			const title = card.querySelector('h3').textContent.toLowerCase();
			const instructor = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();

			if (title.includes(searchValue) || instructor.includes(searchValue)) {
				card.style.display = 'block';
			} else {
				card.style.display = 'none';
			}
		});
	}
</script>