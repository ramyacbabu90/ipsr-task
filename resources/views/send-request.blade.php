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
                <h4>Send Request Here</h4>
               
        </div>
        <div class="row" style="padding-top: 35px;">
        	<div class="col-md-8">
        		
                 <form role="form" class="form" id="js-form-request" method="post" action="{{url('send-request')}}" >
                    <input type="hidden" id="js-token" name="_token" value="<?php echo csrf_token(); ?>">

                    <div class="row" style="padding-top: 15px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="js-name">Question Syllabus</label>
                        <textarea name="user_input" id="js-user_input" class="form-control" rows="5" required=""></textarea>  
                    </div>
                </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="js-price">Select Question type</label>
                        <select name="question_type" id="js-question_type" class="form-control" required="">
                            <option value="">Select Question type</option>
                            <option value="Fill-in-the-Blank" >Fill-in-the-Blank</option>
                            <option value="True or False" >True or False</option>
                            <option value="Multiple Choice Questions" >Multiple Choice Questions</option>
                        </select>
                    </div>
                </div>
                </div>
                
            </div>
            <div class="row " style="padding-top: 15px;">
                <div class="col-md-4">
                <button type="submit" class="btn btn-success" name="submit" id="js-submit" value="">Submit</button>
            </div>
            </div>
                 </form>
        	</div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

	$(document).ready(function(){
		
            $("#js-form-request").validate({
            rules: {
                user_input: {
                  required: true,
                  minlength: 2,
                  maxlength:150,
                  },
                question_type: {
                      required:true,
                  },
              
              },
              messages: {
               user_input: "Syllabus Required to generate questions",
               question_type:"Select Question Type",
              },
            errorElement:"span",
            errorClass: "error-msg",
           errorPlacement:function( error, element ){
              error.insertAfter(element.parent());
            },
        });//END VALIDATE

	});//end ready
</script>
@endsection
