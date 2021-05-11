<?php
    $pageTitle = "Bienvenue";
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 d-flex flex-wrap">
            <div class="row">
                <div class="col-md-4">
                    <img src="asset/img/miniaturecarre.jpg" class="img-thumbnail rounded-circle float-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-secondary px-1">Template Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Uncompleted Profile">
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between px-1">
                            <label for="exampleInputEmail1" class="form-label  text-secondary">Subject</label>
                            <div class="form-text">insert system variable</div>
                        </div>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label text-secondary px-1">Template Name</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="asset/img/miniature.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary">Button</a><a href="#" class="btn btn-light ml-1">Button</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label  text-secondary">Subject</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-secondary">Send to Group</label>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
            </div>
            <div class="d-flex mb-3">
                <a href="#" class="btn btn-primary">Valider</a><a href="#" class="btn btn-light ml-1">Annuler</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group my-3">
                <label for="exampleFormControlSelect1" class="text-secondary">Tap target</label>
                <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlSelect1" class="text-secondary">Set type</label>
                <div class="form-check d-flex align-items-center mb-1">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label d-block bg-success rounded p-1 text-white" for="flexRadioDefault2">
                        Default checked radio
                    </label>
                </div>
                <div class="form-check d-flex align-items-center mb-1">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label d-block bg-info rounded p-1 text-white" for="flexRadioDefault2">
                        Default checked radio
                    </label>
                </div>
                <div class="form-check d-flex align-items-center mb-1">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label d-block bg-warning rounded p-1 text-dark" for="flexRadioDefault2">
                        Default checked radio
                    </label>
                </div>
                <div class="form-check d-flex align-items-center mb-1">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label d-block bg-primary rounded p-1 text-white" for="flexRadioDefault2">
                        Default checked radio
                    </label>
                </div>
                <div class="form-check d-flex align-items-center mb-1">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label d-block bg-danger rounded p-1 text-white" for="flexRadioDefault2">
                        Default checked radio
                    </label>
                </div>
            </div>
            <a href="#" class="btn btn-danger">Supprimer</a>
        </div>
    </div>
</div>