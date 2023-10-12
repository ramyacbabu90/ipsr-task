<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Assignment IPSR</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    @yield('css')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light"></div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('open-ai-request')}}">Send Request</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('question-bank')}}">Question Bank</a>
                
                
            </div>
        </div>
        
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            

            <!-- Page content-->
            <div class="container-fluid">
                <input type="hidden" name="_tocken" id="_tocken" value="{{ csrf_token() }}">
                <input type="hidden" id="base_path" value="{{url('/')}}">
                @yield('content')
            </div>

        </div>
    </div>

</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#_tocken').val()
        }
    });
</script>
@yield('script')
</html>
