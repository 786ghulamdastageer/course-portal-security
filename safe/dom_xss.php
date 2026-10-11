<!DOCTYPE html>
<html>
<head><title>DOM XSS Demo (Safe)</title></head>
<body>
<h2>Welcome to Course Portal (Safe)</h2>
<p id="greeting"></p>

<script>

    var name = location.hash.substring(1);
    document.getElementById('greeting').textContent = "Hello, " + name;
</script>
</body>
</html>
