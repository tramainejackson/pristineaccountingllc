@extends('layouts.app')

@section('content')

    <div class="container mt-5 pt-5">

        <!--Section: Content-->
        <section class="text-center dark-grey-text">

            <!-- Section heading -->
            <h3 class="font-weight-bold mb-4 pb-2 mt-5">About Me</h3>

            <div class="testimonial">
                <!--Avatar-->
                <div class="avatar mx-auto mb-4">
                    <img src="{{ asset('/images/ashley_2.png') }}" class="rounded-circle img-fluid" alt="Ashley avatar image">
                </div>
                <!--Content-->
                <p>
                    <i class="fas fa-quote-left"></i>Pristine Accounting was built on personal experience, so we understand the struggles
                    with becoming financial savvy from all avenues. Our primary goal is to help individuals
                    build a foundation to help their unique financial situation. Our clients are greeted with
                    professionalism, understanding, and personal interaction.
                    Pristine Accounting consists of trained staff with over 11 years of accounting experience
                    with education in Accounting, Fraud and Forensic Accounting, and Economic Crime.
                </p>

                <h4 class="font-weight-bold py-lg-3">Ashley Clark-Jackson</h4>

                <h6 class="font-weight-bold my-3 mb-5 pb-3">Founder at Pristine Accounting LLC</h6>
            </div>
        </section>
        <!--Section: Content-->
    </div>

@endsection