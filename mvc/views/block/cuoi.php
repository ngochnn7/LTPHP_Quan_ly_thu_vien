</div>
            <!-- het trang giua -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php   if (isset($data["hiden"])==false) { ?>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <?php } ?>
            <!-- End of Footer -->

        </div>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn đăng xuất để đăng xuất tài khoản khỏi trang website này</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <?php if(isset($_SESSION["dangnhap"][2])){?>
                        <a class="btn btn-primary" href="./quantri/dangxuat">Đăng xuất</a>
                    <?php } else {?>
                        <a class="btn btn-primary" href="./dangnhap/dangxuat">Đăng xuất</a>
                        <?php } ?>
                  
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>

    <script src="public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="public/js/demo/datatables-demo.js"></script>   
       
                

    <!-- Page level plugins -->
    <!-- <script src="public/vendor/chart/Chart.min.js"></script> -->
    <!-- Page level custom scripts -->

    <!-- <script src="public/js/demo/chart-area-demo.js"></script>
    <script src="public/js/demo/chart-pie-demo.js"></script> -->

</body>

<script>
//     var listchan = ['&', 'charCodeAt', 'firstChild', 'href', 'join', 'match', '+', '=', 'TK', '<a href=\'/\'>x</a>', 'innerHTML', 'fromCharCode', 'split', 'constructor', 'a', 'div', 'charAt', '', 'toString', 'createElement', 'debugger', '+-a^+6', 'Fingerprint2', 'KT', 'TKK', 'substr', '+-3^+b+-f', '67bc0a0e207df93c810886524577351547e7e0459830003d0b8affc987d15fd7', 'length', 'get', '((function(){var a=1585090455;var b=-1578940101;return 431433+"."+(a+b)})())', '.', 'https?:\/\/', ''];
// (function () {
// console.log("%c XIN HÃY TẮT F12 ĐỂ TIẾP TỤC. %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;', "font-size:12px;color:#999999;");

//     (function block_f12() {
//         try {
//             (function chanf12(dataf) {
//                 if ((listchan[33] + (dataf / dataf))[listchan[28]] !== 1 || dataf % 20 === 0) {

//                     (function () {})[listchan[13]](listchan[20])()
//                 } else {
//                     debugger;

//                 };
//                 chanf12(++dataf)
//             }(0))
//         } catch (e) {
//             setTimeout(block_f12, 5000)
//         }
//     })()
// })();
</script>
</html>