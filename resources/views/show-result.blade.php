@extends('layout')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    .error-msg {
        color: #dd6565;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h4>Generated Questions</h4>
               
        </div>
        <div class="row" style="padding-top: 35px;">
        	<div class="col-md-12">
        		    <p><b>Syllabus:</b> {{$input['user_input']}}</p>
                <p><b>Type of Questions:</b>{{$input['question_type']}}</p>
                
                <input type="hidden" name="id" id="js-req-id" value="{{$id}}">
                <button class="btn btn-success" name="save" id="js-save">Save to Question Bank</button>
        	</div>
        </div>
        <div class="row" style="padding-top: 35px;">
           <div class="accordion" id="faqAccordion">
            @if(isset($question) && !empty($question))
            @foreach($question as $k => $q)
          <div class="accordion-item">
              <h2 class="accordion-header" id="question{{$k}}">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer{{$k}}" aria-expanded="true" aria-controls="answer{{$k}}">
                      Question {{$k+1}}: {{$q['question']}}
                  </button>
              </h2>
              <div id="answer{{$k}}" class="accordion-collapse collapse @if($k==0) show @endif" aria-labelledby="question{{$k}}" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    @if($input['question_type'] == 'True or False')
                      {{ ($q['answer']) ? 'True':'False' }}
                    @elseif($input['question_type'] == 'Multiple Choice Questions')
                      @if(isset($q['options']) && !empty($q['options']))
                          <ol>
                        @foreach($q['options'] as $i=> $o)
                            <li>{{$o}}</li>
                        @endforeach
                          </ol>
                      @elseif(isset($q['choices']) && !empty($q['choices']))
                          <ol>
                        @foreach($q['choices'] as $i=> $o)
                            <li>{{$o}}</li>
                        @endforeach
                          </ol>
                      @elseif(isset($q['answers']) && !empty($q['answers']))
                          <ol>
                        @foreach($q['answers'] as $i=> $o)
                            <li>{{$o}}</li>
                        @endforeach
                          </ol>
                      @else
                      <p>Random Options</p>
                      @endif
                      <hr>
                      @if(isset($q['answer']))
                        Ans:{{$q['answer']}}
                      @elseif(isset($q['correct_answer']))
                        Ans:{{$q['correct_answer']}}
                      @endif

                    @else
                      {{$q['answer']}}
                    @endif
                  </div>
              </div>
          </div>
          @endforeach
        @endif

        <!-- <div class="accordion-item">
            <h2 class="accordion-header" id="question2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer2" aria-expanded="false" aria-controls="answer2">
                    Question 2: What is Bootstrap?
                </button>
            </h2>
            <div id="answer2" class="accordion-collapse collapse" aria-labelledby="question2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Bootstrap is a popular open-source front-end framework for building responsive and mobile-first web applications.
                </div>
            </div>
        </div> -->

        <!-- Add more questions and answers as needed -->
    </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

	$(document).ready(function(){
		
            $('#js-save').on('click', function(){

              var req_id = $('#js-req-id').val();
              console.log(req_id);

              if(confirm("Are you sure to Add this Questions to question Bank???")){  

                  $.ajax({
                  type: 'post',
                  url: '{{ route("save-question") }}',
                  dataType: "json",
                  data: {req_id: req_id},
                  success: function(res) {
                    alert('Questions Saved Successfully');
                      setTimeout(function() {
                        window.location.href = "{{URL::to('open-ai-request')}}"
                      }, 1500);
                  },
                  error : function(error) {
                    alert('Request Error');
                  }
                });

              }

            });//end click

	});//end ready
</script>
@endsection
