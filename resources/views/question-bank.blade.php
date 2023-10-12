@extends('layout')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    .error-msg {
        color: #dd6565;
    }
    .relative.z-0.inline-flex.shadow-sm.rounded-md {
      display: none;
    }
    .accordion-button {
      display: block ;
    }

</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h4>Question Bank</h4>
               
        </div>
        @if(isset($question) && count($question) > 0)
        <div class="row" style="padding-top: 35px;">
           <div class="accordion" id="faqAccordion">
            
              @foreach($question as $k => $q)
              <div class="accordion-item">
                  <h2 class="accordion-header" id="question{{$k}}">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer{{$k}}" aria-expanded="true" aria-controls="answer{{$k}}">
                          Question {{$k+1}}: {!! $q['question'] !!}
                      </button>
                  </h2>
                  <div id="answer{{$k}}" class="accordion-collapse collapse @if($k==0) show @endif" aria-labelledby="question{{$k}}" data-bs-parent="#faqAccordion">
                      <div class="accordion-body">
                     
                          Ans:{{$q['answer']}}
                       
                      </div>
                  </div>
              </div>
              @endforeach
              {{ $question->links() }}
        </div>

        </div>
        @else
            <div class=" row col-md-8" style="padding-top: 85px;">
                 <h4>No Questions added yet</h4>
                 
            </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection
