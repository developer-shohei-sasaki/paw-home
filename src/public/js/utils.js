// DOMの読み込みが完了したら実行
document.addEventListener('DOMContentLoaded', function() {
    setupZipCodeListener();
});

// お気に入りボタンの状態定数
const FAVORITE_STATES = {
    UNFAVORITED: {
        text: '☆ お気に入り登録',
        classes: ['btn-outline-warning']
    },
    FAVORITED: {
        text: '★ お気に入り登録済',
        classes: ['btn-warning']
    }
};

/**
 * お気に入り状態を切り替える
 * @param {HTMLElement} element - お気に入りボタン要素
 * @param {number} rescuePetsId - 対象のペットID
 */
async function switchFavorite(element, rescuePetsId) {
    try {
        await axios.post('/pet/favorite', { rescue_pets_id: rescuePetsId });

        const isCurrentlyFavorite = element.innerHTML === FAVORITE_STATES.FAVORITED.text;
        const newState = isCurrentlyFavorite ? FAVORITE_STATES.UNFAVORITED : FAVORITE_STATES.FAVORITED;

        updateFavoriteButtonState(element, newState);
    } catch (error) {
        console.error('お気に入り登録に失敗しました:', error);
        alert('お気に入り登録に失敗しました。もう一度お試しください。');
    }
}

/**
 * お気に入りボタンの状態を更新する
 * @param {HTMLElement} element - 更新対象のボタン要素
 * @param {Object} newState - 新しい状態（FAVORITE_STATESのいずれか）
 */
function updateFavoriteButtonState(element, newState) {
    element.innerHTML = newState.text;
    element.classList.remove(...Object.values(FAVORITE_STATES).flatMap(state => state.classes));
    element.classList.add(...newState.classes);
}

/**
 * 郵便番号から住所情報を取得する
 * @param {string} zipCode - ハイフンなしの7桁郵便番号
 * @returns {Promise<Object>} - 住所情報を含むオブジェクト
 */
async function fetchAddressByZipCode(zipCode) {
    try {
        // 郵便番号が7桁でない場合は処理しない
        if (zipCode.length !== 7) {
            return null;
        }

        // 郵便番号検索APIを呼び出す
        const response = await axios.get(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipCode}`);

        // APIからのレスポンスを確認
        if (response.data.status === 200 && response.data.results) {
            const addressData = response.data.results[0];
            return {
                prefecture: addressData.address1, // 都道府県
                city: addressData.address2,       // 市区町村
                town: addressData.address3,       // 町域
                fullAddress: `${addressData.address1}${addressData.address2}${addressData.address3}`
            };
        }
        return null;
    } catch (error) {
        console.error('住所情報の取得に失敗しました:', error);
        return null;
    }
}

/**
 * 郵便番号入力時のイベントハンドラ
 */
function setupZipCodeListener() {
    const zipCodeInput = document.getElementById('zip-code');
    const addressInput = document.getElementById('address');

    if (!zipCodeInput || !addressInput) return;

    zipCodeInput.addEventListener('input', async function(e) {
        const zipCode = e.target.value;

        // 入力が7桁になったら住所検索を実行
        if (zipCode.length === 7) {
            // 検索中を表示
            addressInput.value = '検索中...';

            const addressData = await fetchAddressByZipCode(zipCode);

            if (addressData) {
                // 住所を設定
                addressInput.value = addressData.fullAddress;
            } else {
                // 検索結果がない場合
                addressInput.value = '';
            }
        }
    });
}
