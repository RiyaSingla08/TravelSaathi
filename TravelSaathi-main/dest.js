const packagesData = [
    { destination: 'Paris', packageName: 'Paris Adventure', price: '$1500', details: '5 days in Paris, including Eiffel Tower tickets.' },
    { destination: 'New York', packageName: 'New York City Tour', price: '$1200', details: '3 days in NYC with city tours.' },
    { destination: 'Tokyo', packageName: 'Tokyo Experience', price: '$1600', details: 'Cultural tour with local guide.' },
    // Add more packages as needed
];

document.getElementById('search-btn').addEventListener('click', function() {
    const destinationInput = document.getElementById('destination').value.toLowerCase();
    const packagesContainer = document.getElementById('packages');
    packagesContainer.innerHTML = ''; // Clear previous results

    const filteredPackages = packagesData.filter(package => 
        package.destination.toLowerCase().includes(destinationInput)
    );

    if (filteredPackages.length === 0) {
        packagesContainer.innerHTML = '<p>No packages found for this destination.</p>';
    } else {
        filteredPackages.forEach(pkg => {
            const packageCard = document.createElement('div');
            packageCard.className = 'package-card';
            packageCard.innerHTML = `
                <h3>${pkg.packageName}</h3>
                <p>${pkg.details}</p>
                <p><strong>Price: ${pkg.price}</strong></p>
            `;
            packagesContainer.appendChild(packageCard);
        });
    }
});
