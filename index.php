
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<form id="form">
  <div>
    <label for="prompt">Prompt:</label>
    <textarea id="prompt" name="prompt"></textarea>
  </div>
  <div>
    <label for="temperature">Temperature:</label>
    <input type="range" id="temperature" name="temperature" min="0" max="1" step="0.01" value="0.5">
  </div>
  <div>
    <button type="submit">Submit</button>
  </div>
</form>
<div id="response"></div>

<script>
$(document).ready(function() {
  $("#form").submit(function(e) {
    e.preventDefault();

    var apiKey = "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";
    var prompt = $("#prompt").val();
    var temperature = $("#temperature").val();

    $.ajax({
      type: "POST",
      url: "https://api.openai.com/v1/engines/davinci/jobs",
      headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer " + apiKey
      },
      data: JSON.stringify({
        "prompt": prompt,
        "max_tokens": 100,
        "temperature": temperature
      }),
      success: function(data) {
        $("#response").text(data.choices[0].text);
      },
      error: function(xhr, status, error) {
        $("#response").text("Error: " + error);
      }
    });
  });
});
</script>
