import { ref } from "vue";

/**
 * このカスタムフックは、特定のタイプのメッセージ（エラー、成功、警告、情報）を設定する機能を提供します。
 * 以下の example に示すように、関数にmessageを渡すだけで、目的のメッセージを設定できます。
 *
 * @returns {Object} 以下を含むオブジェクト:
 * - message: メッセージ内容のためのrefオブジェクト。
 * - messageType: メッセージのタイプ（エラー、成功、警告、情報）のためのrefオブジェクト。
 * - setErrorMessage: エラーメッセージを設定する関数。
 * - setSuccessMessage: 成功メッセージを設定する関数。
 * - setWarningMessage: 警告メッセージを設定する関数。
 * - setInfoMessage: 情報メッセージを設定する関数。
 *
 * @example
 * ```
 * <template>
 *   <div>
 *     <!-- メッセージ表示用のアラートコンポーネント -->
 *     <div v-if="message" :class="`alert-${messageType}`">
 *       {{ message }}
 *     </div>
 *     <!-- エラーメッセージを設定するボタン -->
 *     <button @click="setErrorMessage('エラーが発生しました')">エラーメッセージ</button>
 *     <!-- 成功メッセージを設定するボタン -->
 *     <button @click="setSuccessMessage('操作が成功しました')">成功メッセージ</button>
 *   </div>
 * </template>
 *
 * <script>
 * import { ref } from 'vue';
 * const { message, messageType, setErrorMessage, setSuccessMessage } = useMessage();
 * setErrorMessage('エラーが発生しました');
 * console.log(message.value); // "エラーが発生しました"
 * console.log(messageType.value); // "error"
 *
 * setSuccessMessage('操作が成功しました');
 * console.log(message.value); // "操作が成功しました"
 * console.log(messageType.value); // "success"
 * </script>
 * ```
 */
export function useMessage() {
  const message = ref("");
  const messageType = ref("");

  /**
   * メッセージ状態をエラーメッセージに設定します。
   *
   * @param {string} msg - 表示するエラーメッセージ。
   * @example
   * setErrorMessage('ログインに失敗しました');
   */
  function setErrorMessage(msg) {
    message.value = msg;
    messageType.value = "error";
  }

  /**
   * メッセージ状態を成功メッセージに設定します。
   *
   * @param {string} msg - 表示する成功メッセージ。
   * @example
   * setSuccessMessage('データが正常に保存されました');
   */
  function setSuccessMessage(msg) {
    message.value = msg;
    messageType.value = "success";
  }

  /**
   * メッセージ状態を警告メッセージに設定します。
   *
   * @param {string} msg - 表示する警告メッセージ。
   * @example
   * setWarningMessage('この操作は推奨されません');
   */
  function setWarningMessage(msg) {
    message.value = msg;
    messageType.value = "warning";
  }

  /**
   * メッセージ状態を情報メッセージに設定します。
   *
   * @param {string} msg - 表示する情報メッセージ。
   * @example
   * setInfoMessage('新しいバージョンが利用可能です');
   */
  function setInfoMessage(msg) {
    message.value = msg;
    messageType.value = "info";
  }

  return { message, messageType, setErrorMessage, setSuccessMessage, setWarningMessage, setInfoMessage };
}
