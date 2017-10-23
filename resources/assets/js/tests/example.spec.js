import { mount } from 'vue-test-utils';
import Example from '../components/Example.vue';
import expect from 'expect';

describe('Example', () => {

	it('display example test', () => {
		var wrapper = mount(Example);

		expect(wrapper.vm.count).toBe(0);
	});
});
