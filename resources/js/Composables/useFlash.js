import { usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import { watch, nextTick } from 'vue'

export function useFlash() {
    const toast = useToast()
    const page = usePage()

    const showFlashMessages = (flash) => {
        if (!flash || !flash.message) return

        let severity = flash.style
        let summary = ''

        switch (flash.style) {
            case 'success':
                summary = 'สำเร็จ'
                break
            case 'error':
                summary = 'เกิดข้อผิดพลาด'
                break
            case 'warn':
                summary = 'คำเตือน'
                break
            case 'info':
                summary = 'ข้อมูล'
                break
        }

        toast.add({
            severity,
            summary,
            detail: flash.message,
            life: 5000,
        })
    }

    watch(
        () => page.props.jetstream?.flash,
        (newFlash) => {
            if (newFlash) {
                nextTick(() => {
                    showFlashMessages(newFlash)
                })
            }
        },
        { immediate: true, deep: true }
    )
}