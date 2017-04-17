
<html>

<head>

    </style>
    <link rel="stylesheet" href="resources/stylesheet.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>


<body>

    <form class="form-horizontal" method=post action="upload.php">
        <fieldset>
            <div class="form-group">
                <label class="col-md-4 control-label">Song Title</label>
                <div class="col-md-4">
                    <input id="title" name="title" type="text" class="form-control input-md" required="">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 control-label">Artist Name</label>
                <div class="col-md-4">
                    <input id="artist" name="artist" type="text" class="form-control input-md" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">URL</label>
                <div class="col-md-4">
                    <input id="url" name="url" type="text" class="form-control input-md" required="">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label" for="button"></label>
                <div class="col-md-4 center-block">
                    <button id="button" name="button" class="btn btn-primary center-block">Submit</button>
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>