<!DOCTYPE html>
<html>
<head><title>DOM XSS Demo</title></head>
<body>
<h2>Welcome to Course Portal</h2>
<p id="greeting"></p>

<script>

    var name = location.hash.substring(1);
    document.getElementById('greeting').innerHTML = "Hello, " + name;
</script>
</body>
</html>
