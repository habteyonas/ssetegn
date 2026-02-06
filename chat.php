<!DOCTYPE html>
<html>
<head>
<title>Gemini Support Chat</title>
</head>
<body>

<div>
  <input id="msg" placeholder="Ask something">
  <button onclick="send()">Send</button>
  <pre id="out"></pre>
</div>

<script>
function send() {
  const m = document.getElementById('msg').value;

  fetch('gemini_api.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({message: m})
  })
  .then(r => r.json())
  .then(d => {
    document.getElementById('out').textContent += "\nGemini: " + d.reply;
  });
}
</script>

</body>
</html>
