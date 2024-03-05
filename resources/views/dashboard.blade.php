<x-app-layout>
   <h1>
        Saldo da conta: {{$user->saldo}}
   </h1>
   
   <style>
      h1{
         color: aliceblue;
         padding: 50px;
      }

      button{
         padding: 50px;
         margin: 10px;
         color: aliceblue;
      }
      
      input{
         border-radius: 15px;
         position: absolute;
         left: 50%;
         top: 28%;
         transform: translate(-50%, -50%);
         text-align: center;
         padding-top: 50px;
         color: 2#0f0e0e;
         align-items: center;
         line-height: 50px;
         background: #333333;
      }
      
      
   </style>
   
   @include('profile.modal')
   <form method="POST">
    @csrf
    @method("POST")
    
    <input type="number" name="valor">
    <button type="submit" formaction="{{route('pagar')}}">Pagar</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Transferência
    </button>
    {{-- <button type="submit" formaction="{{route('transferir')}}">Transferência</button> --}}
    <button type="submit" formaction="{{route('depositar')}}">Depositar</button>
    <button type="submit" formaction="{{route('sacar')}}">Saque</button>
    @if(session('success'))
    <h1>
       <div class="alert alert-success">
          {{ session('success') }}
         </div>
      </h1>
   @endif
   </form>
</x-app-layout>

