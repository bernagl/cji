<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php 
    $action = $_GET['action'];
?>

    <?php if($action): ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase.js"></script>
    <script src="./moment.js"></script>
    <script src="./firebaseInit.js"></script>
    <script>
        $(document).ready(function (e) {
            db.ref('usuario').once('value').then(function (usersObject) {
                console.log(usersObject.val())
                const usersValue = usersObject.val()
                const users = Object.keys(usersValue).map(function (user) {
                    return Object.assign({
                        id: user
                    }, usersValue[user])
                })

                users.forEach(function (user) {
                    // db.ref('usuario').child(user.id).update({
                    //     status: 1
                    // }).then(r => console.log(r)).catch(e => console.log(e))
                    if (user['expires']) {
                        const now = moment()
                        const expires = moment(user.expires)
                        const difference = moment.duration(moment(user.expires).diff(moment()))
                        const differenceAsDays = Math.round(difference.asDays())
                        if (differenceAsDays > 4 && differenceAsDays < 7) {
                            console.log('user ' + user.nombre + ' expire credits in ' +
                                differenceAsDays + ' days')
                        } else if (differenceAsDays >= 1 && differenceAsDays <= 3) {
                            console.log('user ' + user.nombre + ' has ' + differenceAsDays +
                                'days')
                        } else if (differenceAsDays === 0) {
                            console.log('user ' + user.nombre + ' his credits has been expired')
                            db.ref('usuario').child(user.id).update({
                                invitado: false,
                                creditos: {
                                    '-LPrNpstwZt7J3NLUJXc': 0,
                                    '-LJ5w7hFuZxYmwiprTIY': 0
                                }
                            }).then(function () {
                                console.log('user ' + user.nombre + ' has been reset')
                            })
                        } else console.log('user ' + user.nombre + ' has enough days ' +
                            differenceAsDays)
                    } else {
                        // console.log(user)
                        // console.log(moment().add('1', 'M').format())
                        db.ref('usuario').child(user.id).update({
                            expires: moment().add('1', 'M').format()
                        }).then(function () {
                            console.log('user ' + user.nombre + ' expire date updated')
                        })
                    }
                })
            })
        })
    </script>
    <?php else: ?>
    <script>
        console.log('...')
    </script>
    <?php endif; ?>
</body>

</html>