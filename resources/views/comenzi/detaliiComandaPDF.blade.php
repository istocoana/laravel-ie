<!DOCTYPE html>
<html>
<head>
    <title>Detalii comandă PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
  <h1>Detalii comandă</h1>
  <p>ID comandă: {{ $comanda->id }}</p>
  <p>Produse achiziționate:</p>
  <ul>
      @foreach ($comanda->eveniment as $event)
          <li>
              Nume event: {{ $event->titlu }}
          </li>
          <li>
            Pret bilet:{{ $event->pret }}
          </li>
          <li>
            Total comandă: {{ $comanda->numar_bilete_achizitionate }} x {{ $event->pret }} RON = 
            {{ $comanda->numar_bilete_achizitionate * $event->pret }} RON
        </li>
      @endforeach
  </ul>
</body>
</html>
