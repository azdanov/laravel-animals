import ky from 'ky'

export default ky.extend({
  prefixUrl: process.env.MIX_APP_URL,
  credentials: 'include',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
  },
})
