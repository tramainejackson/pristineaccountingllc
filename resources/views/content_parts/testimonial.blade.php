<!-- Testimonial -->
<div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

        <div class="col-12 text-center" id="">
            <h2 class>Please Take Our Quick Survey</h2>
        </div>

        <div class="col-12" id="">
            <p>As a startup company, feedback from our customers are extremely important for us to make sure we are on the right path. Please take my quick survey so I know how we are doing.</p>
        </div>

        <div class="col-12" id="">

            <!-- Testimonial Form -->
            <form method="POST" action="" class="form">

                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="form-row" id="">
                    <!-- Grid column -->
                    <div class="col-4">
                        <!--Blue select-->
                        <select name="meet_needs" class="mdb-select md-form">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <label class="mdb-main-label" for="meet_needs">Did we meet all of your needs?</label>
                        <!--/Blue select-->
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-4">
                        <!--Blue select-->
                        <select name="recommend" class="mdb-select md-form">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <label class="mdb-main-label" for="recommend">Would you recommend us to someone else?</label>
                        <!--/Blue select-->
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-4">
                        <!-- Material input -->
                        <div class="md-form">
                            <input name="rating" type="number" class="form-control" id="" step="0.5" min="0" max="5">
                            <label for="rating" >How would you rate us from 1-5?</label>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 mb-3">
                        <!--Material textarea-->
                        <div class="md-form">
                          <textarea name="suggestions" id="" class="md-textarea form-control" rows="5">{{ old('suggestions') ? old('suggestions') : '' }}</textarea>
                          <label for="suggestions">What could we have done differently?</label>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 mb-3">
                        <!--Material textarea-->
                        <div class="md-form">
                          <textarea name="tell_someone" id="" class="md-textarea form-control" rows="5">{{ old('tell_someone') ? old('tell_someone') : '' }}</textarea>
                          <label for="tell_someone">What would you tell someone who's considering our business?</label>
                        </div>
                    </div>
                    <!-- Grid column -->
                </div>
            </form>
            <!-- Testimonial Form -->
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
</div>
<!-- Testimonial -->