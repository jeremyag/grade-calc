<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <style>
            .height-expand {
                height: 100%;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://github.com/jeremyag/grades-calc">Source Code Link</a>
                </li>
            </ul>
        </div>
    </nav>
        <br>
        <div class="container">
            <h1>Grades Calculator</h1>
            <div class="row">
                <div class="col-6">
                    <div class="card height-expand">
                        <div class="card-header">
                            Input
                        </div>
                        <div class="card-body">
                            <form action="submit.php" method="post">
                                <label>Input:</label>
                                <textarea class="form-control" name="input">Quarter 1, 2019
Susan Smith H 75 88 94 95 84 68 91 74 100 82 93 T 73 82 81 92 85
John Wright H 86 55 96 78 T 82 89 93 70 74 H 93 85 80 74 76 82 62 
Jane Jones T 88 94 100 82 95 H 84 66 74 98 92 85 100 95 96 42 88
Jimmy Doe H 73 99 98 83 85 92 100 60 74 98 92 T 84 96 79 91 95
Suzy Johnson H 65 72 78 80 82 74 76 0 85 75 76 T 74 79 70 83 78</textarea>
                                <br>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card height-expand">
                        <div class="card-header">
                            Choose File
                        </div>
                        <div class="card-body">
                            <form>
                                <label>Input txt file:</label>
                                <a class="btn btn-secondary" href="sample.txt" target="_blank" download>Download Sample Txt</a>
                                <br><br>
                                <input type="file" class="form-control"></textarea>
                                <br>
                                <div class="text-end">
                                   
                                    <button type="button" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <?php require_once("gradelist.php"); ?>
                </div>
            </div>
        </div>
    </body>
</html>