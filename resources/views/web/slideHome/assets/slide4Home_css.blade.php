<style>
.slide4-bg-video-container {
  position: relative;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}
.slide4-bg-video {
  position: absolute;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  z-index: 1;
  transform: scale(0.6) translateY(180px);
  transition: transform 1.2s ease-in-out, opacity 1.2s ease-in-out;
}
.slide4-bg-video.video-animate-in {
  transform: scale(1) translateY(0);
}

.slide4-scroll-content {
  position: relative;
  z-index: 2;
  width: 100%;
  height: 100vh;
  overflow-x:hidden;
  overflow-y:scroll;
}

.slide4-content-wrapper {
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
}
.slide4-white-box {
  position: relative;
  background: #fff;
  width: calc(100vw - 224px);
  max-width: 1200px;
  margin: 87px 112px;
  padding-bottom: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  transform: translateY(100vh);
  transition: transform 1.6s ease, opacity 1.6s ease;
}
.slide4-white-box.whitebox-animate-in {
  transform: translateY(0vh);
}
.slide4-logo {
  width: 250px;
  height: 108px;
  margin-top: 20px;
  display: block;
}
.slide4-main-img {
  margin-top: 17px;
  max-width: 100%;
  height: auto;
  display: block;
}
.slide4-text-box {
  margin-top: 26px;
  width: 700px;
  max-width: 90vw;
  text-align: center;
  color: #1d1d1b;
  font-family: 'Montserrat', sans-serif;
  font-size: 20px;
  line-height: 28px;
  font-weight: 400;
}


.slide4-link-arrow {
  position: absolute;
  right: 36px;
  bottom: 33px;
  display: flex;
  align-items: center;
  gap: 20px;
  color: inherit;
  text-decoration: none;
  font-size: 16px;
  font-weight: 600;
  width:155px; 
  height:20px; 
  border-bottom:solid 2px;
  transition: all 0.3s ease;
  color: #1d1d1b;
  font-family: 'Montserrat', sans-serif;
  justify-content:space-between;

}

.slide4-link-arrow .arrow-img {
  width: 13px;
  height: 13px;
  transition: transform 0.3s;
  
}
.slide4-link-arrow:hover {
  color: #009fe3;
  border-bottom: 2px solid #009fe3;
}
.slide4-link-arrow:hover .arrow-img {
  transform: rotate(45deg);
  content: url("web/images/arrow_azzurra.png");
}

.slide4-extra-section {
  position: relative;
  width: 100%;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 143px;
  z-index: 3;
}

.slide4-block {
  width: 466px;
  height: 670px;
  background: #fff;
  transform: translateY(100vh);
  transition: transform 1.5s ease;
}

.slide4-block.animate-in {
  transform: translateY(0);
}

.slide4-block.left {
  transition-delay: 0.2s;
}

.slide4-block.right {
  transition-delay: 0.5s;
}
.slide4-link-arrow2 {
    bottom:20px;
    left:50%;
    transform:translateX(-50%);
  }
  .slide4-block-content{
    padding:20px 30px;
    display:flex;
    flex-direction:column;
    text-align:center;
  }
  .slide4-block-content-title{
    height:64px;
    overflow:hidden;
    font-size:26px;
    font-weight:300;
    line-height:normal;
    margin-top:13px; 
  }
  .slide4-block-content-text{
    height:72px;
    overflow:hidden;
    font-size:16px;
    font-weight:300;
    line-height:normal;
    margin-top:13px; 
  }
@media screen and (max-width: 1200px) {
  .slide4-link-arrow {
    position:relative;
    right:0;
    bottom:0;
    margin-top:20px;
    margin-left:auto;
    margin-right:40px;
    display:block;
  }
  .slide4-link-arrow2 {
    position:absolute;
    right:auto;
    left:50%;
    transform:translateX(-50%);
    bottom:20px;
  }
  .slide4-extra-section {
    gap: 40px;
  }
}
@media screen and (max-width: 1024px) {
  .slide4-block{
    height:auto;
  }


  .slide4-block-content{
    padding:20px 0px 60px;
  }
  .slide4-text-box {
    width:100%;
    max-width:calc(100% - 40px);
    font-size:16px;
    line-height:24px;
  }
  .slide4-extra-section {
    width:calc(100% - 40px);
    margin:40px 30px 40px 20px;
  }
}
@media screen and (max-width:650px) {
  .slide4-extra-section {
    gap: 20px;
  }
  .slide4-block-content-title{
    font-size:20px;
    height:48px;
  }
  .slide4-block-content-text{
    font-size:14px;
    height:120px;
    padding:0 10px;
  }
}
@media screen and (max-width:500px) {
  .slide4-block {
    width:100%;
  }
  .slide4-extra-section {
    flex-direction: column;
    gap: 40px;
  }
  .slide4-block-content-text{
    height:80px;
  }
  .slide4-white-box {
    width:calc(100% - 40px);
    margin:40px 30px 40px 20px;
    padding-bottom:20px;
  }
  .slide4-logo {
    width:150px;
    height:68px;
  }
  .slide4-main-img {
    margin-top:10px;
  }
  .slide4-text-box {
    font-size:14px;
    line-height:20px;
  }
}
</style> 