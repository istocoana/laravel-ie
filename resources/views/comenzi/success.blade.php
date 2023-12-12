<form action="{{ route('success') }}" method="POST" id="successForm">
  @csrf
  {{-- <input type="hidden" name="session_id" value="{{ $session_id }}"> --}}
 
  <button type="submit">Redirectare către succes</button>
</form>

<script>
  window.onload = function() {
      document.getElementById('successForm').submit();
  };
</script>
