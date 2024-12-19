<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container  mt-5 "> 
        <div class="row">
            <div class="col-md-6 info mt-5 ">
                   <h1>Sai Courier & Cargo Mgmt</h1>
            </div>
            <div class="col-md-6 login_form mt-5">

<h2 class="text-center">Login</h2>
<form action="login.php" method="post" class="mt-4">
    <div class="mb-3 ">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button class="login">Login</button>
</form>
</div>
            </div>
        </div>

    </div> 


    
</body>
</html>
