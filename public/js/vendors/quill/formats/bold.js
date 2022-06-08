import Inline from '../../../../../../../../vendors/quill-1.3.6/blots/inline';

class Bold extends Inline {
  static create() {
    return super.create();
  }

  static formats() {
    return true;
  }

  optimize(context) {
    super.optimize(context);
    if (this.domNode.tagName !== this.statics.tagName[0]) {
      this.replaceWith(this.statics.blotName);
    }
  }
}
Bold.blotName = 'bold';
Bold.tagName = ['STRONG', 'B'];

export default Bold;
