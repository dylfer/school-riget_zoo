function incrementValue(id) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    if (currentValue < parseInt(input.max)) {
        input.value = currentValue + 1;
      }
  }

  function decrementValue(id) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    if (currentValue > parseInt(input.min)) {
      input.value = currentValue - 1;
    }
  }

   // Point values
   const POINTS_PER_ADULT = 50;
   const POINTS_PER_CHILD = 25;

   // Get DOM elements
   const adultsInput = document.getElementById('adults');
   const childrenInput = document.getElementById('children');
   const pointsDisplay = document.getElementById('pointsDisplay');
   const form = document.getElementById('ticketForm');
   const usePointsCheckbox = document.getElementById('usePoints');
   const pointsToRedeemInput = document.getElementById('pointsToRedeem');

   // Function to calculate total points
   function calculatePoints() {
     const adults = parseInt(adultsInput.value) || 0;
     const children = parseInt(childrenInput.value) || 0;
     
     const totalPoints = (adults * POINTS_PER_ADULT) + (children * POINTS_PER_CHILD);
     pointsDisplay.textContent = totalPoints;
   }

   // Increment/Decrement functions
   function incrementValue(id) {
     const input = document.getElementById(id);
     const currentValue = parseInt(input.value) || 0;
     if (currentValue < parseInt(input.max)) {
       input.value = currentValue + 1;
       calculatePoints();
     }
   }

   function decrementValue(id) {
     const input = document.getElementById(id);
     const currentValue = parseInt(input.value) || 0;
     if (currentValue > parseInt(input.min)) {
       input.value = currentValue - 1;
       calculatePoints();
     }
   }

   // Toggle points redemption input
   usePointsCheckbox.addEventListener('change', function() {
     pointsToRedeemInput.disabled = !this.checked;
     if (!this.checked) {
       pointsToRedeemInput.value = '';
     }
   });

   // Add event listeners for direct input changes
   adultsInput.addEventListener('input', calculatePoints);
   childrenInput.addEventListener('input', calculatePoints);

   // Calculate initial points
   calculatePoints();

   // Handle form submission
   form.addEventListener('submit', function(e) {
     e.preventDefault();
     const pointsEarned = pointsDisplay.textContent;
     const pointsRedeemed = usePointsCheckbox.checked ? pointsToRedeemInput.value : 0;
     const discount = pointsRedeemed / 100; // $1 per 100 points
     
     Swal.fire({
       title: 'Added to Basket!',
       html: `
         <p>Points earned: ${pointsEarned}</p>
         ${pointsRedeemed ? `<p>Points redeemed: ${pointsRedeemed}</p>
         <p>Discount applied: $${discount.toFixed(2)}</p>` : ''}
       `,
       icon: 'success',
       confirmButtonText: 'OK',
       confirmButtonColor: '#2563eb'
     });
   });