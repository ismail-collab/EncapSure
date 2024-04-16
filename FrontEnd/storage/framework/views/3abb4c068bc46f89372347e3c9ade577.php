<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #1e52a8;
        border-radius: 10px;
    }

    h2 {
        color: #ffffff;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #ffffff;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ffffff;
        border-radius: 5px;
    }

    button[type="submit"], button[type="button"] {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 10px;
    }

    button[type="submit"] {
        background-color: #008000;
    }

    button[type="submit"]:hover {
        background-color: #ffffff;
    }

    button[type="button"] {
        background-color: #ff6666;
    }

    button[type="button"]:hover {
        background-color: #ffffff;
    }
    







</style>
</head>
<body>


    
<div class="container">
    <h2><i class="fas fa-user-cog"></i> Gestion du compte</h2>
    <form id="account-form">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="account-email">Email :</label>
            <input type="text" id="account-email" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="account-password">Mot de passe :</label>
            <input type="password" id="account-password" class="form-control">
       
            <div class="form-group">
                <label for="confirm-password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm-password" class="form-control">
            </div>

            <button type="submit" class="btn btn-block">
                <i class="fas fa-sync-alt"></i> Mettre à jour
            </button>
            
        
            <button type="button" class="btn btn-block" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Retour
            </button>
            
        </form>       
    </div>
    <script>
    
    document.getElementById('account-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('account-email').value.trim();
        const password = document.getElementById('account-password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();
    
        document.querySelectorAll('.error-message').forEach(el => el.remove());
    
        let hasErrors = false;
    
        if (username === '') {
            showError('username', "Le nom d'utilisateur est obligatoire.");
            hasErrors = true;
        }
    
        if (email === '') {
            showError('account-email', "L'adresse e-mail est obligatoire.");
            hasErrors = true;
        } else {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                showError('account-email', 'Veuillez entrer une adresse e-mail valide.');
                hasErrors = true;
            }
        }
    
        if (password === '') {
            showError('account-password', 'Le mot de passe est obligatoire.');
            hasErrors = true;
        } else if (password.length < 8) {
            showError('account-password', 'Le mot de passe doit contenir au moins 8 caractères.');
            hasErrors = true;
        }
    
        if (confirmPassword === '') {
            showError('confirm-password', 'La confirmation du mot de passe est obligatoire.');
            hasErrors = true;
        } else if (password !== confirmPassword) {
            showError('confirm-password', 'Les mots de passe ne correspondent pas.');
            hasErrors = true;
        }
    
        if (!hasErrors) {
            alert('Mise à jour du compte réussie !');
        }
    });
    
    function showError(inputId, message) {
const input = document.getElementById(inputId);
const errorMessage = document.createElement('div');
errorMessage.className = 'error-message';
errorMessage.style.fontSize = '0.8em';
errorMessage.style.marginTop = '5px';
errorMessage.style.fontWeight = 'bold';
errorMessage.style.textDecoration = 'underline';
errorMessage.style.color = '#ff6666';
errorMessage.textContent = message;
input.parentNode.appendChild(errorMessage);
}

function resetForm() {
document.getElementById('account-form').reset();
document.querySelectorAll('.error-message').forEach(el => el.remove());
}

function goBack() {
window.location.href = "Home";
}

</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientSettings.blade.php ENDPATH**/ ?>