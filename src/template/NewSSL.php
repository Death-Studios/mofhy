<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <h1 class="page-title">
                New SSL Certificate
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
        <?php if (isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);}?>
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New SSL Certificate</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="function/NewSSL">
                                <div class="mb-3"> <label class="form-label" for="domain">Domain Name</label> <input type="text" id="domain" class="form-control" name="domain" value="" placeholder="example.com"> </div>
                                <p>The www. subdomain is automatically included.</p>
                                <button type="submit" name="submit" class="btn btn-primary">Check Domain</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3"></div>
            </div>
        </div>
    </div>