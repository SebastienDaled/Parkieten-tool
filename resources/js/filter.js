// Get the filter elements
const sizeFilter = document.getElementById('size-filter');
const typeFilter = document.getElementById('type-filter');

// Add event listeners to the filter elements
sizeFilter.addEventListener('change', applyFilters);
typeFilter.addEventListener('change', applyFilters);

// Function to apply filters
function applyFilters() {
  const selectedSize = sizeFilter.value;
  const selectedType = typeFilter.value;

  // Loop through all rings and show/hide based on the selected filters
  const rings = document.querySelectorAll('.ring-item');
  for (let i = 0; i < rings.length; i++) {
    const ringElement = rings[i];
    const size = ringElement.dataset.size;
    const type = ringElement.dataset.type;

    let showRing = true;

    // Apply size filter
    if (selectedSize !== '' && selectedSize !== size) {
      showRing = false;
    }

    // Apply type filter
    if (selectedType !== '' && selectedType !== type) {
      showRing = false;
    }

    // Show/hide the ring element based on filters
    if (showRing) {

      ringElement.classList.remove('d-none');
    } else {
      ringElement.classList.add('d-none');

    }
  }
}
