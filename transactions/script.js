function filterElements() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const elements = document.querySelectorAll('.elements-div');

    elements.forEach(element => {
        const text = element.querySelector('p').innerText.toLowerCase();
        if (text.includes(filter)) {
            element.style.display = 'flex';
        } else {
            element.style.display = 'none';
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    var labels = document.querySelectorAll('.navbar-title');
    var tooltips = document.querySelectorAll('.tooltip-content');
    var timers = {};

    labels.forEach(function(label, index) {
        var tooltip = tooltips[index];
        var labelId = label.id;

        label.addEventListener('mouseenter', function() {
            clearTimeout(timers[labelId]);
            closeAllTooltips();
            tooltip.style.display = 'block';
        });

        label.addEventListener('mouseleave', function() {
            startCloseTimer(labelId);
        });

        tooltip.addEventListener('mouseenter', function() {
            clearTimeout(timers[labelId]);
        });

        tooltip.addEventListener('mouseleave', function() {
            startCloseTimer(labelId);
        });
    });

    function startCloseTimer(id) {
        timers[id] = setTimeout(function() {
            closeAllTooltips();
        }, 200);
    }

    function closeAllTooltips() {
        tooltips.forEach(function(tooltip) {
            tooltip.style.display = 'none';
        });
    }
});


    const elements = document.querySelectorAll('.elements-div');
    const displayingDiv = document.querySelector('.displaying div');

    elements.forEach(element => {
    element.addEventListener('click', () => {
        const elementContent = element.querySelector('p').innerText;
        displayingDiv.innerText = `Selected Element: ${elementContent}`;
    });
});


function showTabContent(tab) {

    // Remove "active" class from all tabs
    const tabs = document.querySelectorAll('.tab div');
    tabs.forEach(t => t.classList.remove('active'));

    // Add "active" class to the clicked tab
    tab.classList.add('active');

    // Hide all content divs
    const contentDivs = document.querySelectorAll('.elements, .history-content');
    contentDivs.forEach(div => (div.style.display = 'none'));

    // Show the corresponding content based on the clicked tab
    if (tab.innerText === 'Мои переводы') {
        document.querySelector('.elements').style.display = 'flex';
    } else if (tab.innerText === 'История') {
        document.querySelector('.history-content').style.display = 'flex';
    }
}

function updateDestination(selectId) {
    var sourceSelect = document.getElementById("source");
    var destinationSelect = document.getElementById("destination");

    // Get the selected value from the triggering select
    var selectedValue = sourceSelect.options[sourceSelect.selectedIndex].value;
    var destinationValue = destinationSelect.options[destinationSelect.selectedIndex].value;

    // Update the destination select based on the selected value
    if (selectId === "source") {
        if (selectedValue === "gold") {
            destinationSelect.value = "deposit";
        } else if (selectedValue === "deposit") {
            destinationSelect.value = "gold";
        }
    } else if (selectId === "destination") {
        if (destinationValue === "gold") {
            sourceSelect.value = "deposit";
        } else if (destinationValue === "deposit") {
            sourceSelect.value = "gold";
        }
    }
}