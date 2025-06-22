<div class="modal fade" id="report">
  <div class="modal-dialog limit-w modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
      <h5 class="text-white mb-0">Report Error</h5>
      <div class="mt-2">
        <div><b>Superstar Associate Manager</b></div>
        <div class="text-primary current-type-number text-title"></div>
      </div>
      <form class="mt-3" method="post" action="ajax/manga/report">
        <input type="hidden" name="type" /> <input type="hidden" name="id" />
        <div class="form-group mt-4 mb-2"><textarea class="form-control" name="message" rows="3" placeholder="Please describe your issue here"></textarea></div>
        <div class="form-group"><span class="captcha d-flex justify-content-centerz" data-theme="dark"></span></div>
        <button class="submit btn mt-3 btn-lg btn-primary w-100">Send Report <i class="fa-solid fa-chevron-right fa-xs"></i></button>
      </form>
    </div>
  </div>
</div>
<div class="modal fade advanced-settings">
  <div class="modal-dialog limit-w modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
      <h5>Advanced Settings</h5>
      <ul class="nav nav-tabs" data-tabs=".advanced-settings .tab-content">
        <li class="nav-item"><button class="nav-link active tab" data-name="page-layout">Page Layout</button></li>
        <li class="nav-item"><button class="nav-link tab" data-name="image">Image</button></li>
        <li class="nav-item"><button class="nav-link tab" data-name="shortcut">Shortcuts</button></li>
      </ul>
      <div class="tab-content" data-name="page-layout">
        <div data-show-if="this.display_style != 'disabled'">
          <div class="mb-2">Page Display Style</div>
          <div class="setting-tab page-layout btn-options" data-name="display_style">
            <div data-value="singlepage"><i class="fa-light fa-page"></i> <span>Single Page</span></div>
            <div data-value="doublepage"><i class="fa-light fa-book-open"></i> <span>Double Page</span></div>
            <div data-value="longstrip">
              <svg>
                <use xlink:href="#icon-longstrip" />
              </svg> <span>Long Strip</span>
            </div>
          </div>
          <div data-show-if="this.display_style == 'longstrip'">
            <div class="form-group strip-margin">
              <label for="text">Strip Margin</label> <input type="number" class="form-control mx-2" placeholder="0" min="0" max="30" name="strip_margin_value" />
              <button class="btn btn-secondary1 reset-strip-margin">Reset</button>
            </div>
          </div>
          <div data-show-if="this.display_style == 'singlepage'">
            <div class="custom-control custom-switch mb-4">
              <input type="checkbox" class="custom-control-input" id="enable-lr_swiping" name="enable_lr_swiping" /> <label class="custom-control-label" for="enable-lr_swiping">Enable left/right swiping</label>
            </div>
          </div>
        </div>
        <div class="mb-2">Reading Direction</div>
        <div class="setting-tab read-direction btn-options" data-name="reading_direction">
          <div data-value="ltr"><i class="fa-light fa-square-arrow-right mr-1"></i> <span>Left To Right </span><b>LTR</b></div>
          <div data-value="rtl"><span>Right To Left</span><b>RTL</b> <i class="fa-light fa-square-arrow-left ml-1"></i></div>
        </div>
        <div class="mb-2">Progress Bar Position</div>
        <div class="setting-tab progress-position btn-options" data-name="progress_position">
          <div data-value="top"><i class="fa-light fa-arrow-down-from-line"></i><span>Top </span></div>
          <div data-value="bottom"><i class="fa-light fa-arrow-up-from-line"></i> <span>Bottom</span></div>
          <div data-value="left"><i class="fa-light fa-arrow-right-from-line"></i> <span>Left</span></div>
          <div data-value="right"><i class="fa-light fa-arrow-left-from-line"></i> <span>Right</span></div>
          <div data-value="none"><i class="fa-light fa-dash"></i> <span>None</span></div>
        </div>
        <div class="custom-control custom-switch mb-4">
          <input type="checkbox" class="custom-control-input" id="show_tips" name="show_tips" /> <label class="custom-control-label" for="show_tips">Show tips when header and sidebar are hidden.</label>
        </div>
      </div>
      <div class="tab-content" data-name="image" style="display: none;">
        <div class="mb-2">Image Sizing</div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="image-fit-width" name="image_fit_width" data-enable-if="this.image_fit_width != 'disabled'" />
          <label class="custom-control-label" for="image-fit-width">Contain to width</label>
        </div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="image-fit-height" name="image_fit_height" data-enable-if="this.image_fit_height != 'disabled'" />
          <label class="custom-control-label" for="image-fit-height">Contain to height</label>
        </div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="stretch-small-pages" name="stretch_small_pages" data-enable-if="this.image_fit_width == 1 || this.image_fit_height == 1" />
          <label class="custom-control-label" for="stretch-small-pages">Stretch small pages</label>
        </div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="limit-max-width" name="limit_max_width" data-enable-if="this.image_fit_width == 1" />
          <label class="custom-control-label" for="limit-max-width">Limit max width</label>
        </div>
        <div class="form-group mb-2" data-show-if="this.limit_max_width == 1">
          <div class="d-flex align-items-center">
            <label class="mr-2" for="limit_max_width_value"><span>0</span>px</label>
            <input type="range" class="custom-range form-control-range w-100" min="1" name="limit_max_width_value" data-enable-if="this.image_fit_width == 1 && this.limit_max_width == 1" />
          </div>
        </div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="limit-max-height" name="limit_max_height" data-enable-if="this.image_fit_height == 1" />
          <label class="custom-control-label" for="limit-max-height">Limit max height</label>
        </div>
        <div class="form-group mb-2" data-show-if="this.limit_max_height == 1">
          <div class="d-flex align-items-center">
            <label class="mr-2" for="limit_max_height_value"><span>0</span>px</label>
            <input type="range" class="custom-range form-control-range w-100" min="1" name="limit_max_height_value" data-enable-if="this.image_fit_height == 1 && this.limit_max_height == 1" />
          </div>
        </div>
        <div class="mb-2 mt-4">Image Coloring</div>
        <div class="custom-control custom-switch mb-2">
          <input type="checkbox" class="custom-control-input" id="greyscale-pages" name="greyscale_pages" /> <label class="custom-control-label" for="greyscale-pages">Greyscale pages</label>
        </div>
        <div class="custom-control custom-switch mb-2"><input type="checkbox" class="custom-control-input" id="dim-pages" name="dim_pages" /> <label class="custom-control-label" for="dim-pages">Dim pages</label></div>
        <div class="form-group mb-2" data-show-if="this.dim_pages == 1">
          <label for="dim_pages_value">Dimmed by <span>0</span>%</label> <input type="range" class="custom-range form-control-range w-100" min="0" max="100" name="dim_pages_value" />
        </div>
      </div>
      <div class="tab-content" data-name="shortcut" style="display: none;">
        <div class="mb-2">Keyboard Shortcuts</div>
        <div class="form-group">
          <ul>
            <li><b>H</b>: Toggle show/hide header.</li>
            <li><b>M</b>: Toggle show/hide menu.</li>
            <li><b>N</b>: Skip forward a chapter/volume.</li>
            <li><b>B</b>: Skip backward a chapter/volume.</li>
            <li><b class="fa-solid fa-arrow-right"></b>: Skip a page, forward in LTR or backward in RTL</li>
            <li><b class="fa-solid fa-arrow-left"></b>: Skip a page, backward in LTR or forward in RTL.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>