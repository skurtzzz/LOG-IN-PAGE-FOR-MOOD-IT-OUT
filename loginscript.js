const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
const form = document.querySelector('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const username = document.querySelector('input[name="username"]').value;
  const password = document.querySelector('input[name="password"]').value;

  // Send the form data to the backend
  fetch('loginconnect2.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ username, password }),
  })
  .then(response => response.json())
  .then(data => {
    // Handle the response from the backend (e.g., show success or error messages)
    if (data.error) {
      alert(data.error);
    } else {
      // Redirect to the dashboard page
      window.location.href = 'dashboard.php';
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});

  