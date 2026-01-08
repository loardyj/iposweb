@extends('layout.master')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Daftar Item</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="../main/index.html">Order</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Daftar Item</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">
                    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Animation</h4>
              <p class="card-subtitle">
                Select the animation style class and check the animation to
                the image, you can use any of this animation to anywhere,
                just place exact word. example
                <code>.animated .bounce</code>
              </p>
              <form class="mb-4 mt-5">
                <div class="row justify-content-center">
                  <div class="col-sm-8">
                    <div class="input-group">
                      <select class="form-select js--animations">
                        <optgroup label="Attention Seekers">
                          <option value="bounce">bounce</option>
                          <option value="flash">flash</option>
                          <option value="pulse">pulse</option>
                          <option value="rubberBand">rubberBand</option>
                          <option value="shake">shake</option>
                          <option value="swing">swing</option>
                          <option value="tada">tada</option>
                          <option value="wobble">wobble</option>
                          <option value="jello">jello</option>
                        </optgroup>
                        <optgroup label="Bouncing Entrances">
                          <option value="bounceIn">bounceIn</option>
                          <option value="bounceInDown">bounceInDown</option>
                          <option value="bounceInLeft">bounceInLeft</option>
                          <option value="bounceInRight">
                            bounceInRight
                          </option>
                          <option value="bounceInUp">bounceInUp</option>
                        </optgroup>
                        <optgroup label="Bouncing Exits">
                          <option value="bounceOut">bounceOut</option>
                          <option value="bounceOutDown">
                            bounceOutDown
                          </option>
                          <option value="bounceOutLeft">
                            bounceOutLeft
                          </option>
                          <option value="bounceOutRight">
                            bounceOutRight
                          </option>
                          <option value="bounceOutUp">bounceOutUp</option>
                        </optgroup>
                        <optgroup label="Fading Entrances">
                          <option value="fadeIn">fadeIn</option>
                          <option value="fadeInDown">fadeInDown</option>
                          <option value="fadeInDownBig">
                            fadeInDownBig
                          </option>
                          <option value="fadeInLeft">fadeInLeft</option>
                          <option value="fadeInLeftBig">
                            fadeInLeftBig
                          </option>
                          <option value="fadeInRight">fadeInRight</option>
                          <option value="fadeInRightBig">
                            fadeInRightBig
                          </option>
                          <option value="fadeInUp">fadeInUp</option>
                          <option value="fadeInUpBig">fadeInUpBig</option>
                        </optgroup>
                        <optgroup label="Fading Exits">
                          <option value="fadeOut">fadeOut</option>
                          <option value="fadeOutDown">fadeOutDown</option>
                          <option value="fadeOutDownBig">
                            fadeOutDownBig
                          </option>
                          <option value="fadeOutLeft">fadeOutLeft</option>
                          <option value="fadeOutLeftBig">
                            fadeOutLeftBig
                          </option>
                          <option value="fadeOutRight">fadeOutRight</option>
                          <option value="fadeOutRightBig">
                            fadeOutRightBig
                          </option>
                          <option value="fadeOutUp">fadeOutUp</option>
                          <option value="fadeOutUpBig">fadeOutUpBig</option>
                        </optgroup>
                        <optgroup label="Flippers">
                          <option value="flip">flip</option>
                          <option value="flipInX">flipInX</option>
                          <option value="flipInY">flipInY</option>
                          <option value="flipOutX">flipOutX</option>
                          <option value="flipOutY">flipOutY</option>
                        </optgroup>
                        <optgroup label="Lightspeed">
                          <option value="lightSpeedIn">lightSpeedIn</option>
                          <option value="lightSpeedOut">
                            lightSpeedOut
                          </option>
                        </optgroup>
                        <optgroup label="Rotating Entrances">
                          <option value="rotateIn">rotateIn</option>
                          <option value="rotateInDownLeft">
                            rotateInDownLeft
                          </option>
                          <option value="rotateInDownRight">
                            rotateInDownRight
                          </option>
                          <option value="rotateInUpLeft">
                            rotateInUpLeft
                          </option>
                          <option value="rotateInUpRight">
                            rotateInUpRight
                          </option>
                        </optgroup>
                        <optgroup label="Rotating Exits">
                          <option value="rotateOut">rotateOut</option>
                          <option value="rotateOutDownLeft">
                            rotateOutDownLeft
                          </option>
                          <option value="rotateOutDownRight">
                            rotateOutDownRight
                          </option>
                          <option value="rotateOutUpLeft">
                            rotateOutUpLeft
                          </option>
                          <option value="rotateOutUpRight">
                            rotateOutUpRight
                          </option>
                        </optgroup>
                        <optgroup label="Sliding Entrances">
                          <option value="slideInUp">slideInUp</option>
                          <option value="slideInDown">slideInDown</option>
                          <option value="slideInLeft">slideInLeft</option>
                          <option value="slideInRight">slideInRight</option>
                        </optgroup>
                        <optgroup label="Sliding Exits">
                          <option value="slideOutUp">slideOutUp</option>
                          <option value="slideOutDown">slideOutDown</option>
                          <option value="slideOutLeft">slideOutLeft</option>
                          <option value="slideOutRight">
                            slideOutRight
                          </option>
                        </optgroup>
                        <optgroup label="Zoom Entrances">
                          <option value="zoomIn">zoomIn</option>
                          <option value="zoomInDown">zoomInDown</option>
                          <option value="zoomInLeft">zoomInLeft</option>
                          <option value="zoomInRight">zoomInRight</option>
                          <option value="zoomInUp">zoomInUp</option>
                        </optgroup>
                        <optgroup label="Zoom Exits">
                          <option value="zoomOut">zoomOut</option>
                          <option value="zoomOutDown">zoomOutDown</option>
                          <option value="zoomOutLeft">zoomOutLeft</option>
                          <option value="zoomOutRight">zoomOutRight</option>
                          <option value="zoomOutUp">zoomOutUp</option>
                        </optgroup>
                        <optgroup label="Specials">
                          <option value="hinge">hinge</option>
                          <option value="rollIn">rollIn</option>
                          <option value="rollOut">rollOut</option>
                        </optgroup>
                      </select>
                      <span class="input-group-btn">
                        <button class="btn btn-primary js--triggerAnimation rounded-start-0" type="button">
                          Animate Me !
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
              <!-- / Form -->
              <!-- div -->
              <div class="row justify-content-center">
                <div class="text-center col-lg-4 col-md-6">
                  <span class="d-block" id="animationSandbox">
                    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/backgrounds/img1.jpg" class="img-fluid rounded-1" alt="user" />
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection