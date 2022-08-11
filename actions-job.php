    <?php require_once('db-connect.php'); ?>

     <?php include_once('header.php'); // Include Header once ?>

        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">   
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">New job</h2>
                            </div>
                            <form>
                                <div class="flex-container flex-wrap">
                                    <div class="form-field-wrapper width-large">
                                        <input type="text" placeholder="Job title*"/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <input type="text" placeholder="Location"/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <input type="text" placeholder="Salary"/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <textarea placeholder="Description*"></textarea>
                                    </div>  
                                </div>
                                <button type="submit" class="button">
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); // Include Footer once ?>
