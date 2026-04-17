@extends('web.index')

@if(isset($_SESSION["user_loggato"]) && $_SESSION["user_loggato"] == "si")
    @section('content')
        @php		
            $video_background = "web/video/blue-sea.mp4";
            $img_background = "web/images/testate/storia.jpg";
            $page_title = "Reservation Request";
            $x=0;
            $x++; $breadcrumbs[$x]['titolo']=Lang::get('website.il club'); $breadcrumbs[$x]['link']='';
            $x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
        @endphp
        @include('web.common.page_title')
        
        @include('web.assets.la_storia_css')

        <div id="pagContainer">
            <div style="width:100%; display:flex; gap:35px;">
                <h3 class="gradient-title">{{ $page_title }}</h3>
                <div style="flex:1;">
                    <div class="link-arrow" style="width:163px !important; gap:47px !important; margin-top:30px; padding-left:calc(100% - 163px); padding-bottom:7px; border-bottom:solid 2px;">
                    
                    </div>
                </div>
            </div>

            
            @if( count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="col-lg-12 alert alert-success" role="alert" id="errorMessage" style="background:{{ $message_color }}">
                        <div style="float:left; width:90%;">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">{{ trans('labels.Error') }}:</span>
                            {{ $error }}
                        </div>
                        <div style="float:right; width:10%; text-align:right; cursor:pointer;" onclick="$('#errorMessage').fadeOut();"><b>x</b></div>
                        <div style="clear:both"></div>
                    </div>
                @endforeach
            @endif
            
            <div style="margin-top:30px">
                
                <p>
                    Bookings are to be considered confirmed only after receipt of a confirmation email.<br />Fields marked with an asterisk (*) are obligatory.						</p>
            
                <div style="clear:both;border-bottom:1px solid #eee;margin-bottom:50px;">&nbsp;</div>
                
                @php
                    if(!isset($name)) $name = "";
                    if(!isset($model)) $model = "";
                    if(!isset($flag)) $flag = "";
                    if(!isset($loa)) $loa = "";
                    if(!isset($beam)) $beam = "";
                    if(!isset($draft)) $draft = "";
                    if(!isset($yccs)) $yccs = "";
                    if(!isset($nyyc)) $nyyc = "";
                    if(!isset($ycm)) $ycm = "";
                    if(!isset($regatta)) $regatta = "";
                    if(!isset($surname)) $surname = "";
                    if(!isset($owner)) $owner = "";
                    if(!isset($company)) $company = "";
                    if(!isset($captain)) $captain = "";
                    if(!isset($phone)) $phone = "";
                    if(!isset($email)) $email = "";
                    if(!isset($arrival)) $arrival = "";
                    if(!isset($departure)) $departure = "";
                    if(!isset($address)) $address = "";
                    if(!isset($town)) $town = "";
                    if(!isset($region)) $region = "";
                    if(!isset($zipcode)) $zipcode = "";
                    if(!isset($country)) $country = "";
                    if(!isset($amp16)) $amp16 = "";
                    if(!isset($amp32)) $amp32 = "";
                    if(!isset($v230)) $v230 = "";
                    if(!isset($v320)) $v320 = "";
                    if(!isset($note)) $note = "";
                    
                    $link_form = "area-soci/reservation-request-confirm.html";
                    if($lingua=="eng")$link_form = "en/area-soci/reservation-request-confirm.html";
                    
                    $campo_obbligatorio="Campo obbligatorio"; if($lingua=="eng") $campo_obbligatorio = "Required Field";
                    $required_field = ' required="required"';
                    
                    $email_corretta="Immettere un indirizzo di posta elettronico valido"; if($lingua=="eng") $email_corretta = "Enter a valid email address";
                    $required_email = ' required="required" oninvalid="if(this.validity.typeMismatch){this.setCustomValidity(\''.$email_corretta.'\')}else{this.setCustomValidity(\''.$campo_obbligatorio.'\')}" oninput="setCustomValidity(\'\')"';
                    
                    $privacy_obbligatoria="Autorizzazione della privacy obbligatoria"; if($lingua=="eng") $privacy_obbligatoria = "Privacy Required";
                    $required_privacy = '  required="required"  onchange="this.setCustomValidity(validity.valueMissing ? \''.$privacy_obbligatoria.'\' : \'\');" oninvalid="this.setCustomValidity(\''.$privacy_obbligatoria.'\')" oninput="setCustomValidity(\'\')"';
                @endphp
                
                <style>
                    .form-group label:not(.error) {font-weight: 600; color:#111111}
                    .form-gray-fields .form-control {
                        background-color: #f2f2f2;
                        border-color: #e9e9e9;
                        color: #333;
                    }
                </style>
                
                
                <form action="{{ $link_form }}" method="post" name="requestForm" id="requestForm" autocomplete="off">
                    @csrf
                    <input type="hidden" name="stato_req" value="1"/>
                    <div style="display:flex; gap:50px;">
                        <div style="flex:1">
                            <label for="name">Vessel Name (Full Name) *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php  echo $name; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                        
                        <div style="flex:1">
                            <label for="model">Vessel Model *</label>
                            <input type="text" class="form-control" id="model" name="model" value="<?php  echo $model; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">	
                        <div style="flex:1">
                            <label for="flag">Vessel Flag *</label>
                            <input type="text" class="form-control" id="flag" name="flag" value="<?php  echo $flag; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                        
                        <div style="flex:1">
                            <label for="loa">L.O.A. *</label>
                            <input type="text" class="form-control" id="loa" name="loa" value="<?php  echo $loa; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>		
                    <div style="display:flex; gap:50px;">
                        <div style="flex:1">
                            <label for="beam">Beam *</label>
                            <input type="text" class="form-control" id="beam" name="beam" value="<?php  echo $beam; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                        
                        <div style="flex:1">
                            <label for="draft">Draft *</label>
                            <input type="text" class="form-control" id="draft" name="draft" value="<?php  echo $draft; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">	
                        <div class="form-group col-sm-12">
                            <label for="club">Club Member</label>
                            <div style="display:flex; gap:50px; margin-top:10px;">	
                                <div class="col-sm-3"><input type="checkbox" name="yccs" id="yccs" <?php  if ($yccs=="on") echo "checked=\"checked\""; ?>> &nbsp; YCCS</div>
                                <div class="col-sm-3"><input type="checkbox" name="nyyc" id="nyyc" <?php  if ($nyyc=="on") echo "checked=\"checked\""; ?>> &nbsp; NYYC</div>
                                <div class="col-sm-3"><input type="checkbox" name="ycm" id="ycm" <?php  if ($ycm=="on") echo "checked=\"checked\""; ?>> &nbsp; YCM</div>
                                <div class="col-sm-3"><input type="checkbox" name="regatta" id="regatta" <?php  if ($regatta=="on") echo "checked=\"checked\""; ?>> &nbsp; REGATTA</div>
                            </div>
                        </div>
                    </div>
                    <div style="display:flex; gap:50px; margin-top:20px;">
                        <div class="form-group col-sm-12">
                            <label for="surname">Name and Surname *</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="<?php  echo $surname; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div style="display:flex; gap:50px; margin-top:20px;">
                        <div class="form-group col-sm-12">
                            <label for="type"></label>
                            <div style="display:flex; gap:50px;">	
                                <div class="col-sm-3"><input type="checkbox" name="owner" id="owner" <?php  if ($owner=="on") echo "checked=\"checked\""; ?>> &nbsp; OWNER</div>
                                <div class="col-sm-3"><input type="checkbox" name="company" id="company" <?php  if ($company=="on") echo "checked=\"checked\""; ?>> &nbsp; COMPANY</div>
                                <div class="col-sm-3"><input type="checkbox" name="captain" id="captain" <?php  if ($captain=="on") echo "checked=\"checked\""; ?>> &nbsp; CAPTAIN</div>
                            </div>
                        </div>
                    </div>
                    <div style="display:flex; gap:50px; margin-top:30px;">
                        <div style="flex:1">
                            <label for="phone">Contact Number *</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php  echo $phone; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                        
                        <div style="flex:1">
                            <label for="email">Contact E-mail Address *</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php  echo $email; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">
                        <div style="flex:1">
                            <label for="arrival">Arrival Date *</label>
                            <input type="text" class="mws-datepicker form-control" id="arrival" name="arrival" readonly="readonly" value="<?php  echo $arrival; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                        
                        <div style="flex:1">
                            <label for="departure">Departure Date *</label>
                            <input type="text" class="mws-datepicker form-control" id="departure" name="departure" readonly="readonly" value="<?php  echo $departure; ?>"   required="required"  oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Campo obbligatorio<?php }else{?>Required Field<?php }?>')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">
                        <div class="form-group col-sm-12">
                            <label for="address">Billing Address (For non-members only)</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php  echo $address; ?>">
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">
                        <div style="flex:1">
                            <label for="town">Town</label>
                            <input type="text" class="form-control" id="town" name="town" value="<?php  echo $town; ?>">
                        </div>
                        
                        <div style="flex:1">
                            <label for="region">Region/State</label>
                            <input type="text" class="form-control" id="region" name="region" value="<?php  echo $region; ?>">
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">
                        <div style="flex:1">
                            <label for="zipcode">Zip Code</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php  echo $zipcode; ?>">
                        </div>
                        
                        <div style="flex:1">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="<?php  echo $country; ?>">
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">	
                        <div class="form-group col-sm-12">
                            <label for="shore">Shore Power Options</label>
                            <div style="display:flex; gap:50px; margin-top:10px;">	
                                <div class="col-sm-3"><input type="checkbox" name="amp16" id="amp16" <?php  if ($amp16=="on") echo "checked=\"checked\""; ?>> &nbsp; 16 AMP</div>
                                <div class="col-sm-3"><input type="checkbox" name="amp32" id="amp32" <?php  if ($amp32=="on") echo "checked=\"checked\""; ?>> &nbsp; 32 AMP</div>
                                <div class="col-sm-3"><input type="checkbox" name="v230" id="v230" <?php  if ($v230=="on") echo "checked=\"checked\""; ?>> &nbsp; 230v</div>
                                <div class="col-sm-3"><input type="checkbox" name="v320" id="v320" <?php  if ($v320=="on") echo "checked=\"checked\""; ?>> &nbsp; 320v</div>
                            </div>
                            <div  class="col-sm-12" style="clear:both;height:20px;padding-top:10px"><p>Plese check and indicate how many cables</p></div>
                        </div>
                    </div>
                    <div style="display:flex; gap:50px;">	
                        <div class="form-group col-sm-12" style="margin-top:20px">
                            <label for="note">Special Requests/Comments</label>
                            <textarea id="note" name="note" class="form-control" rows="5"><?php  echo $note; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        Verify Code *:<br/>
                        <div class="g-recaptcha" data-sitekey="6LemiVIUAAAAANtP868RFgIkQ8VIvkCBmL-lnnD5"></div>
                    </div>
                    
                    <div class="form-group" style="margin-top:20px">
                        <?php /*<p>In accordance with d.lgs. 196/2003 (Italy) I authorize the Data Controller to treat this data for the purposes herein indicated. The Data Controller shall not release this information to third parties unless obliged to do so by law.</p>*/?>
                        <label><input type="checkbox" id="privacy" name="privacy" value="0"   required="required"  onchange="this.setCustomValidity(validity.valueMissing ? '<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>' : '');" oninvalid="this.setCustomValidity('<?php if($lingua=="ita"){?>Autorizzazione della privacy obbligatoria<?php }else{?>Privacy Required<?php }?>')" oninput="setCustomValidity('')"/> &nbsp; I declare to have read the notice on processing of personal data (GDPR 679/16), and I authorise processing. *<br /><br /></label>
                        
                    </div>
                    
                    <div class="form-group text-left">
                        <button class="btnYccsWhite" style="width:120px;" type="submit" id="inviaCrew">SEND REQUEST</button>
                    </div>
                </form>
        
            </div>	
        </div>	
    @endsection
@else	
	<script language="javascript">
		window.location = "<?php echo config('app.url');?>/<?php if($lingua=="eng"){?>en/<?php }?>area-soci/login.html";
	</script>
@endif